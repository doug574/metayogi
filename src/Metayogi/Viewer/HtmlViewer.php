<?php

/**
 * This file is part of Metayogi.
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Metayogi\Viewer;

use Metayogi\Foundation\Application;
use Metayogi\Viewer\Html\Region;

/**
 * Builds html pages
 *
 * @package Metayogi
 * @author  Doug Macdonald <doug.macdonald@usask.ca>
 *
 */
class HtmlViewer extends BaseViewer implements ViewerInterface
{
    protected $scripts;
    protected $css;
    protected $js;
    
    public function __construct(Application $app)
    {
        parent::__construct($app);
        $this->scripts = array();
        $this->css = array();
        $this->js = "";
    }

   /**
     * description
     *
     * @param Metayogi\Foundation\Application $app Description
     *
     * @return void
     * @access public
     */
    public function build(Application $app)
    {
        $layout = $this->router->getRoute('layout');
        foreach ($layout['regions'] as $regionName => $properties) {
            if (! empty($properties['name'])) {
                $region = new Region();
                $region->build($app, $properties);
#                $region->properties['layout'] = $layout['layout'];
                $this->regions[$regionName] = $region;
            }
        }

        $this->css = array (
            'http://netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css',
            'http://netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-theme.min.css',
            );
        
        $this->scripts = array (
            'http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js',
            'http://netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js',
            );
    }
    
    /**
     * description
     *
     * @return string
     * @access public
     */
    public function render()
    {
        $this->regions['center']->addContent($this->display);
    
        $html = "<!DOCTYPE html>\n";
        $html .= "<html lang='en'>\n";
        $html .= $this->head();
        $html .= $this->body();
        $html .= "</html>\n";
        
        return $html;
    }

    /**
     * description
     *
     * @return string
     * @access protected
     */
    protected function head()
    {
        $html = "<head>\n";
        $html .= "<meta http-equiv='content-type' content='text/html; charset=utf-8' />\n";
        $html .= "<meta name='viewport' content='width=device-width, initial-scale=1.0'>\n";
        $html .= "<meta http-equiv='X-UA-Compatible' content='IE=edge'>\n";

        /*
        * Add CSS script files
        */
        foreach ($this->css as $file) {
            $html .= "<link rel='stylesheet' type='text/css' href='$file' />\n";
        }
        
        /*
        * Add javascript script files
        */
        foreach ($this->scripts as $script) {
            $html .= "<script type='text/javascript' src='$script'></script>\n";
        }

       $html .= "
<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script type='text/javascript' src='http://html5shim.googlecode.com/svn/trunk/html5.js'></script>
    <![endif]-->
";

        $html .= $this->addReady();        
        $html .= "</head>\n";

        return $html;
    }
    
    /**
     * description
     *
     * @return string
     * @access protected
     */
    protected function body()
    {
        $html = "<body>\n";
        if (! empty($this->regions)) {
            foreach ($this->regions as $regionName => $obj) {
                if (is_object($obj)) {
                    $html .= $obj->render();
                }
            }
        }
        $html .= "</body>\n";

        return $html;
    }
    
   /**
     * description
     *
     * @return string
     * @access protected
     */
    protected function addReady()
    {
        $html = "<script type='text/javascript'>\n";
        $html .= "$(document).ready(function() {\n";
        $html .= $this->js;
        $html .= "});\n";
        $html .= "</script>\n";

        return $html;
    }

    /**
     * description
     *
     * @param string $code Description
     *
     * @return void
     * @access public
     */
    public function addJS($code)
    {
        $this->js .= $code;
    }

}
