              </div>
            </div>
          </div>
        </div>

        <div id="left">
          <div class="nav_heading">
            {$LANG.phrase_module_nav}
          </div>
          <div id="module_nav">
	          {ft_include file="module_menu.tpl"}
          </div>

          <br />

          <div class="nav_heading">
            {$LANG.phrase_main_nav}
          </div>
          <div id="main_nav">
					  {ft_include file="menu.tpl"}
					</div>
        </div>

      </div>

      <div class="clear"></div>

    </div>
  </div>
</div>


{* only display the footer area if there is some text entered for it *}
{if $account.settings.footer_text != "" || $g_enable_benchmarking}
  <div id="footer">
    {$account.settings.footer_text}
    {show_page_load_time}
  </div>
{/if}

</body>
</html>
