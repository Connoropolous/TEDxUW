/**
 * This file contains all the client-side code for all tests in the module.
 */

var sc_ns = {

  // common vars (used for all, or most tests)
  is_processing: false, // any time a test is running
  component_list: [],   // contains "core" and/or any module IDs, depending on what's selected for the test
  current_component: null, // core / module ID
  current_component_name: null, // for display purposes


  /**
   * This initiates the test process for any of the tests, called from the individual test pages. It
   * does the following:
   *
   * 1. Clears the logs already outputted
   * 2. marks the test as having begun (is_processing = true)
   * 3. stores the list of components (module IDs + core) that the user selected
   * 4. Calls the appropriate init test function
   */
  start: function(start_test_func) {
    sc_ns.clear_logs();
    sc_ns.is_processing = true;
    sc_ns.component_list = [];
    sc_ns.file_verification_problems = null;
    sc_ns.total_orphan_tests_run = 0;
    sc_ns.total_num_orphans_found = 0;

    $(".components:checked").each(function() {
      sc_ns.component_list.push(this.value);
      $("#result__" + this.value).removeClass("passed failed").addClass("untested").html(g.messages["word_untested"]);
    });

    if (!sc_ns.component_list.length) {
      ft.display_message("ft_message", 0, g.messages["validation_no_components_selected"]);
      return;
    }

    sc_ns.current_component = sc_ns.component_list[0];
    start_test_func();
  },

  clear_logs: function() {
    $("#full_log,#error_log").val("");
  },

  log_error: function(error) {
    $("#error_log").val($("#error_log").val() + error + "\n\n");
  },

  log_message: function(message) {
    $("#full_log").val($("#full_log").val() + message + "\n");
  },


  // ----------------------------------------------------------------------------------------------

  // Table Verification

  current_component_tables: [],
  current_component_table: null,
  current_component_has_problems: false,
  any_tested_component_has_problem: false,


  /**
   * Called for each component on the Table Verification page. This method returns all tables
   * for the component, which are passed to sc_ns.verify_component_tables which does the actual
   * verification.
   */
  init_component_table_test: function() {
    $("#result__" + sc_ns.current_component).html("<img src=\"images/loading.gif\" />");
    $.ajax({
      url:      g.root_url + "/modules/system_check/global/code/actions.php",
      data:     { action: "get_component_tables", component: sc_ns.current_component },
      type:     "POST",
      dataType: "json",
      success:  sc_ns.test_component_tables
    })
  },


  /**
   * Called after a test for a component has been started. It's passed a single array back
   * from the server. The first index contains the string name of the component to be tested,
   * the second contains the component type ("core" or "module"), and the remainder of the
   * array contains the table names.
   */
  test_component_tables: function(component_info) {
    sc_ns.current_component_name   = component_info.tables.shift();
    sc_ns.current_component        = component_info.tables.shift();
    sc_ns.current_component_tables = component_info.tables;
    sc_ns.current_component_table  = component_info.tables[0];

    // update the log section
    var log = g.messages["word_testing_c"] + sc_ns.current_component_name + "\n"
            + "------------------------------------------\n"
            + g.messages["text_tables_test"] + "\n";

    // if this isn't the first thing outputted to the log, add some visual padding
    if ($("#full_log").val() != "")
      log = "\n\n" + log;

    sc_ns.log_message(log);

    // now start processing this component's tables
    sc_ns.verify_component_tables();
  },

  verify_component_tables: function() {
    $.ajax({
      url:      g.root_url + "/modules/system_check/global/code/actions.php",
      data:     { action: "verify_table", component: sc_ns.current_component, table_name: sc_ns.current_component_table },
      type:     "POST",
      dataType: "json",
      success:  sc_ns.display_table_test_results
    });
  },

  display_table_test_results: function(results) {

    // check all the problem scenarios
    var has_problem = false;
    if (!results.table_exists) {
      sc_ns.log_error(sc_ns.current_component_name + " - " + g.messages["phrase_missing_table_c"] + results.table_name);
      has_problem = true;
    } else {
      if (results.missing_columns.length > 0) {
        for (var i=0; i<results.missing_columns.length; i++) {
          sc_ns.log_error(sc_ns.current_component_name + " - " + results.table_name + " - " + g.messages["phrase_missing_column_c"]
          + results.missing_columns[i]);
        }
        has_problem = true;
      }
      if (results.invalid_columns.length > 0) {
        for (var i=0; i<results.invalid_columns.length; i++) {
          sc_ns.log_error(sc_ns.current_component_name + " - " + results.table_name + " - " + g.messages["phrase_invalid_column_c"]
            + results.invalid_columns[i].column + "\n"
            + "   - is: " + results.invalid_columns[i].invalid_values.is + "\n"
          + "   - should be: " + results.invalid_columns[i].invalid_values.should_be);
        }
        has_problem = true;
      }
    }

    if (!has_problem) {
      sc_ns.log_message("- " + g.messages["phrase_table_looks_good_c"] + results.table_name);
    } else {
      sc_ns.any_tested_component_has_problem = true;
      sc_ns.current_component_has_problems = true;
    }

    // now process the next table, continue to the next component or display the "complete" message
    var next_table = null;
    for (var i=0; i<sc_ns.current_component_tables.length-1; i++) {
      if (sc_ns.current_component_tables[i] == sc_ns.current_component_table) {
        next_table = sc_ns.current_component_tables[i+1];
        break;
      }
    }

    if (next_table != null) {
      sc_ns.current_component_table = next_table;
      sc_ns.verify_component_tables();
    } else {
      $("#result__" + sc_ns.current_component).removeClass("untested");
      if (sc_ns.current_component_has_problems) {
        $("#result__" + sc_ns.current_component).addClass("failed").html(g.messages["word_failed"]);
      } else {
        $("#result__" + sc_ns.current_component).addClass("passed").html(g.messages["word_passed"]);
      }

      var next_component = null;
      for (var i=0; i<sc_ns.component_list.length-1; i++) {
        if (sc_ns.component_list[i] == sc_ns.current_component) {
          next_component = sc_ns.component_list[i+1];
          break;
        }
      }
      if (next_component != null) {
        // reset some stuff for the next pass
        sc_ns.current_component_has_problems = false;
        sc_ns.current_component_table = null;
        sc_ns.current_component = next_component;
        sc_ns.init_component_table_test();

      // here we're done!
      } else {
        if (sc_ns.any_tested_component_has_problem) {
          ft.display_message("ft_message", 1, g.messages["notify_test_complete_problems"]);
        } else {
          ft.display_message("ft_message", 1, g.messages["notify_test_complete_no_problems"]);
        }
        return;
      }
    }
  },


  // ----------------------------------------------------------------------------------------------

  // Hook Verification

  hook_verification_failed_module_ids: [],

  /**
   * Called for each component.
   */
  init_component_hook_test: function() {
    $("#result__" + sc_ns.current_component).html("<img src=\"images/loading.gif\" />");
    $.ajax({
      url:      g.root_url + "/modules/system_check/global/code/actions.php",
      data:     { action: "verify_module_hooks", module_id: sc_ns.current_component },
      type:     "POST",
      dataType: "json",
      success:  sc_ns.display_hook_verification_result
    })
  },

  display_hook_verification_result: function(json) {
    switch (json.result) {
      case "pass":
        var message = json.module_name + ": Pass!";
        sc_ns.log_message(message);
        break;
      case "too_many_hooks":
      var message = json.module_name + ": ERROR, too many hooks";
        sc_ns.log_message(message);
        sc_ns.log_error(message);
        sc_ns.hook_verification_failed_module_ids.push(json.module_id);
        break;
      case "missing_hooks":
        var message = json.module_name + ": ERROR, missing hooks";
        sc_ns.log_message(message);
        sc_ns.log_error(message);
        sc_ns.hook_verification_failed_module_ids.push(json.module_id);
        break;
      case "invalid_hooks":
      var message = json.module_name + ": ERROR, invalid hooks";
        sc_ns.log_message(message);
        sc_ns.log_error(message);
        sc_ns.hook_verification_failed_module_ids.push(json.module_id);
        break;
    }

    $("#result__" + sc_ns.current_component).removeClass("untested");
    if (json.result == "pass") {
      $("#result__" + sc_ns.current_component).addClass("passed").html(g.messages["word_passed"]);
    } else {
      $("#result__" + sc_ns.current_component).addClass("failed").html(g.messages["word_failed"]);
    }

    var next_component = null;
    for (var i=0; i<sc_ns.component_list.length-1; i++) {
      if (sc_ns.component_list[i] == sc_ns.current_component) {
        next_component = sc_ns.component_list[i+1];
        break;
      }
    }

    if (next_component != null) {
      // reset some stuff for the next pass
      sc_ns.current_component_has_problems = false;
      sc_ns.current_component = next_component;
      sc_ns.init_component_hook_test();

      // here we're done!
    } else {
      if (sc_ns.hook_verification_failed_module_ids.length) {
        ft.display_message("ft_message", 0, g.messages["notify_hook_verification_complete_problems"]);
      } else {
        ft.display_message("ft_message", 1, g.messages["notify_test_complete_no_problems"]);
      }
      return;
    }
  },


  // ----------------------------------------------------------------------------------------------

  // File Verification

  file_verification_problems: null,

  /**
   * Called for each component.
   */
  init_component_file_test: function() {
    $("#result__" + sc_ns.current_component).html("<img src=\"images/loading.gif\" />");
    $.ajax({
      url:      g.root_url + "/modules/system_check/global/code/actions.php",
      data:     { action: "verify_component_files", component: sc_ns.current_component },
      type:     "POST",
      dataType: "json",
      success:  sc_ns.display_file_verification_result
    })
  },

  display_file_verification_result: function(json) {
    var component_type = json.component_type;
    if (json.result == "pass") {
      var message = json.component_name + ": PASS. All files found";
      sc_ns.log_message(message);
    } else {
      var message = json.component_name + ": FAIL. Missing files";
      sc_ns.log_message(message);

      var error_message = message + "\n";
      for (var i=0; i<json.missing_files.length; i++) {
    	error_message+= "- " + json.missing_files[i] + "\n";
      }
      sc_ns.log_error(error_message);
    }


    // now process the next table, continue to the next component or display the "complete" message
    $("#result__" + sc_ns.current_component).removeClass("untested");
    if (json.result == "pass") {
      $("#result__" + sc_ns.current_component).addClass("passed").html(g.messages["word_passed"]);
    } else {
      $("#result__" + sc_ns.current_component).addClass("failed").html(g.messages["word_failed"]);
      sc_ns.file_verification_problems = true;
    }

    var next_component = null;
    for (var i=0; i<sc_ns.component_list.length-1; i++) {
      if (sc_ns.component_list[i] == sc_ns.current_component) {
        next_component = sc_ns.component_list[i+1];
        break;
      }
    }
    if (next_component != null) {
      // reset some stuff for the next pass
      sc_ns.current_component = next_component;
      sc_ns.init_component_file_test();

    // here we're done!
    } else {
      if (sc_ns.file_verification_problems != null) {
        ft.display_message("ft_message", 0, g.messages["notify_file_verification_complete_problems"]);
      } else {
        ft.display_message("ft_message", 1, g.messages["notify_test_complete_no_problems"]);
      }
      return;
    }
  },


  // ----------------------------------------------------------------------------------------------

  // Orphan Record Check

  total_orphan_tests_run: 0,
  total_num_orphans_found: 0,

  /**
   * Called for each component on the Table Verification page. This method returns all tables
   * for the component, which are passed to sc_ns.verify_component_tables which does the actual
   * verification.
   */
  init_orphan_record_test: function() {
    $("#result__" + sc_ns.current_component).html("<img src=\"images/loading.gif\" />");
    $.ajax({
      url:      g.root_url + "/modules/system_check/global/code/actions.php",
      data:     { action: "get_component_tables", component: "core" },
      type:     "POST",
      dataType: "json",
      success:  sc_ns.find_orphan_records
    });
  },

  find_orphan_records: function(core_info) {
    sc_ns.current_component_name   = core_info.tables.shift();
    sc_ns.current_component        = core_info.tables.shift();
    sc_ns.current_component_tables = core_info.tables;
    sc_ns.current_component_table  = core_info.tables[0];

    // update the log section
    var log = g.messages["word_testing_c"] + sc_ns.current_component_name + "\n"
            + "------------------------------------------\n";

    // if this isn't the first thing outputted to the log, add some visual padding
    if ($("#full_log").val() != "")
      log = "\n\n" + log;

    sc_ns.log_message(log);

    // now start processing this component's tables
    sc_ns.find_next_table_orphans();
  },

  find_next_table_orphans: function() {
    $.ajax({
      url:      g.root_url + "/modules/system_check/global/code/actions.php",
      data:     { action: "find_table_orphans", table_name: sc_ns.current_component_table },
      type:     "POST",
      dataType: "json",
      success:  sc_ns.display_orphan_test_results
    });
  },

  display_orphan_test_results: function(results) {
    var log = "TABLE: " + results.table_name + "\n";
    if (results.has_test) {
      log += "Test description:\n" + results.test_descriptions + "\n"
           + "Results:\n"
           + "- num tests: " + results.num_tests + "\n"
           + "- num orphans: " + results.num_orphans;

      sc_ns.total_orphan_tests_run += results.num_tests;
      sc_ns.total_num_orphans_found += results.num_orphans;
    } else {
      log += "- No test";
    }
    sc_ns.log_message(log);
    sc_ns.log_message("_______________________\n");

    if (results.num_orphans > 0) {
      var log = "TABLE: " + results.table_name + "\n"
              + "- num orphans: " + results.num_orphans + "\n"
              + "- error description: \n";
      for (var i=1; i<=results.problems.length; i++) {
        log += i + ". " + results.problems[i-1] + "\n";
      }
      sc_ns.log_error(log + "_______________________\n");
    }

    var next_table = null;
    for (var i=0; i<sc_ns.current_component_tables.length-1; i++) {
      if (sc_ns.current_component_tables[i] == sc_ns.current_component_table) {
        next_table = sc_ns.current_component_tables[i+1];
        break;
      }
    }

    if (next_table != null) {
      sc_ns.current_component_table = next_table;
      sc_ns.find_next_table_orphans();
    } else {
      var message = "Number of tests run: <b>" + sc_ns.total_orphan_tests_run + "</b>, "
        + "total number of orphans found: <b>" + sc_ns.total_num_orphans_found + "</b>";

      var error_type = 1;
      if (sc_ns.total_num_orphans_found > 0) {
        error_type = 0;
        message += ". <a href=\"orphans.php?clean\">Click here</a> to delete all the orphaned records / references.";
      } else {
        message += ". Passed!";
      }

      ft.display_message("ft_message", error_type, message);
      return;
    }
  }

};
