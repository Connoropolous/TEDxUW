var di = {
  is_processing: false,

  // contains "core" and/or any module IDs
  component_list: [],
  current_component_tables: [],

  current_component: null, // core / module ID
  current_component_name: null, // for display purposes
  current_component_table: null,

  current_component_has_problems: false,
  any_tested_component_has_problem: false,


  /**
   * This initiates the whole testing process. Testing works like so:
   *  1. start_component_test() is called. That calls a function on the server
   *     that returns some log information & an array of tables to test.
   *  2. it then tests various things for each table. When complete, it re-calls
   *     start_component_test() for the next component.
   */
  start: function() {
    di.clear_logs();
    di.is_processing = true;
    di.component_list = [];

    $(".components:checked").each(function() {
      di.component_list.push(this.value);
      $("#result__" + this.value).removeClass("passed failed").addClass("untested").html(g.messages["word_untested"]);
    });

    if (!di.component_list.length) {
      ft.display_message("ft_message", 0, g.messages["validation_no_components_selected"]);
      return;
    }

    di.current_component = di.component_list[0];
    di.start_component_test();
  },


  /**
   * Called for each component.
   */
  start_component_test: function() {
    $("#result__" + di.current_component).html("<img src=\"images/loading.gif\" />");
    $.ajax({
      url:      g.root_url + "/modules/database_integrity/global/code/actions.php",
      data:     { action: "start_component_test", component: di.current_component },
      type:     "POST",
      dataType: "json",
      success:  di.start_process_tables
    })
  },

  /**
   * Called after a test for a component has been started. It's passed a single array back
   * from the server. The first index contains the string name of the component to be tested,
   * the second contains the component type ("core" or "module"), and the remainder of the
   * array contains the table names.
   */
  start_process_tables: function(component_info) {
    di.current_component_name   = component_info.tables.shift();
    di.current_component        = component_info.tables.shift();
    di.current_component_tables = component_info.tables;
    di.current_component_table  = component_info.tables[0];

    // update the log section
    var log = g.messages["word_testing_c"] + di.current_component_name + "\n"
            + "------------------------------------------\n"
            + g.messages["text_tables_test"] + "\n";

    // if this isn't the first thing outputted to the log, add some visual padding
    if ($("#full_log").val() != "")
      log = "\n\n" + log;

    di.log_message(log);

    // now start processing this component's tables
    di.process_tables();
  },


  process_tables: function() {
    $.ajax({
      url:      g.root_url + "/modules/database_integrity/global/code/actions.php",
      data:     { action: "process_table", component: di.current_component, table_name: di.current_component_table },
      type:     "POST",
      dataType: "json",
      success:  di.display_table_test
    });
  },

  display_table_test: function(results) {
    // check all the problem scenarios
    var has_problem = false;
    if (!results.table_exists) {
      di.log_error(di.current_component_name + " - " + g.messages["phrase_missing_table_c"] + results.table_name);
      has_problem = true;
    } else {
      if (results.missing_columns.length > 0) {
        for (var i=0; i<results.missing_columns.length; i++) {
          di.log_error(di.current_component_name + " - " + results.table_name + " - " + g.messages["phrase_missing_column_c"]
          + results.missing_columns[i]);
        }
        has_problem = true;
      }
      if (results.invalid_columns.length > 0) {
        for (var i=0; i<results.invalid_columns.length; i++) {
          di.log_error(di.current_component_name + " - " + results.table_name + " - " + g.messages["phrase_invalid_column_c"]
            + results.invalid_columns[i].column + "\n"
            + "   - is: " + results.invalid_columns[i].invalid_values.is + "\n"
          + "   - should be: " + results.invalid_columns[i].invalid_values.should_be);
        }
        has_problem = true;
      }
    }

    if (!has_problem) {
      di.log_message("- " + g.messages["phrase_table_looks_good_c"] + results.table_name);
    } else {
      di.any_tested_component_has_problem = true;
      di.current_component_has_problems = true;
    }

    // now process the next table, continue to the next component or display the "complete" message
    var next_table = null;
    for (var i=0; i<di.current_component_tables.length-1; i++) {
      if (di.current_component_tables[i] == di.current_component_table) {
        next_table = di.current_component_tables[i+1];
        break;
      }
    }

    if (next_table != null) {
      di.current_component_table = next_table;
      di.process_tables();
    } else {
      $("#result__" + di.current_component).removeClass("untested");
      if (di.current_component_has_problems) {
        $("#result__" + di.current_component).addClass("failed").html(g.messages["word_failed"]);
      } else {
        $("#result__" + di.current_component).addClass("passed").html(g.messages["word_passed"]);
      }

      var next_component = null;
      for (var i=0; i<di.component_list.length-1; i++) {
        if (di.component_list[i] == di.current_component) {
          next_component = di.component_list[i+1];
          break;
        }
      }
      if (next_component != null) {
        // reset some stuff for the next pass
        di.current_component_has_problems = false;
        di.current_component_table = null;
        di.current_component = next_component;
        di.start_component_test();

      // here we're done!
      } else {
        if (di.any_tested_component_has_problem) {
          ft.display_message("ft_message", 1, g.messages["notify_test_complete_problems"]);
        } else {
          ft.display_message("ft_message", 1, g.messages["notify_test_complete_no_problems"]);
        }
        return;
      }
    }
  },

  clear_logs: function() {
    $("#full_log").val("");
    $("#error_log").val("");
  },

  log_error: function(error) {
    $("#error_log").val($("#error_log").val() + error + "\n\n");
  },

  log_message: function(message) {
    $("#full_log").val($("#full_log").val() + message + "\n");
  }

};
