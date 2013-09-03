<?php

/**
 * This file is part of Metayogi.
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Metayogi\Decorator;

 
/**
 * Description 
 *
 * @package Metayogi
 * @author  Doug Macdonald <doug.macdonald@usask.ca>
 *
 */
class ConfirmDecorator extends BaseDecorator implements DecoratorInterface
{

    /**
     * Description
     *
     * @return void
     * @access public
     */
    public function build()
    {
        $this->viewer->addJS($this->addJS());
    }

    /**
     * Description
     *
     * @return string
     * @access public
     */
    public function render()
    {
        $html = "";
        $html .= <<<EOT
<div id="deleteconfirm" title="Confirmation Required" style='display:none;'>
  Are you sure you want to delete this?
</div>
EOT;

        return $html;
    }
    
    /**
     * Description
     *
     * @return string
     * @access public
     */
    protected function addJS()
    {
        return <<<EOT

  $('#deleteconfirm').dialog({
      autoOpen: false,
      modal: true,
  });

  $('.delete').click(function(e) {
    e.preventDefault();
    var targetUrl = $(this).attr('href');

    $('#deleteconfirm').dialog('option', 'buttons', {
        'Confirm' : function() {
          window.location.href = targetUrl;
        },
        'Cancel' : function() {
          $(this).dialog('close');
        }
    });

    $('#deleteconfirm').dialog('open');
  });

EOT;
    }
}
