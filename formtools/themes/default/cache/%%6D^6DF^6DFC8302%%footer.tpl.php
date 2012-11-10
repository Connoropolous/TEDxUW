<?php /* Smarty version 2.6.18, created on 2012-11-02 01:13:38
         compiled from C:%5CSites%5CTEDxUW%5Cformtools/themes/default/footer.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'show_page_load_time', 'C:\\Sites\\TEDxUW\\formtools/themes/default/footer.tpl', 13, false),)), $this); ?>

      </div>
    </td>
  </tr>
  </table>

</div>

<?php if ($this->_tpl_vars['account']['settings']['footer_text'] != "" || $this->_tpl_vars['g_enable_benchmarking']): ?>
  <div class="footer">
    <?php echo $this->_tpl_vars['account']['settings']['footer_text']; ?>

    <?php echo smarty_function_show_page_load_time(array(), $this);?>

  </div>
<?php endif; ?>

</body>
</html>