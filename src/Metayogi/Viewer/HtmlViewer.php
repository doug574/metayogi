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
    /**
    * list of linked javascript files
    * @var array
    */
    protected $scripts;

    /**
    * list of linked css files
    * @var array
    */
    protected $css;

    /**
    * jquery 'ready document' code
    * @var string
    */
    protected $js;
    
    /**
     * Initialize response content
     *
     * @access public
     * @return void
     */
    public function build()
    {
        $this->scripts = array();
        $this->css = array();
        $this->js = "";
        $layout = $this->router->get('layout');
        foreach ($layout['regions'] as $regionName => $properties) {
            if (! empty($properties['name'])) {
                $region = new Region();
                $properties['layout'] = $layout['layout'];
                $region->build($this->app, $properties);
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
     * {@inheritdoc}
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
     * Generates html/head content
     *
     * @access protected
     * @return string
     */
    protected function head()
    {
        $html = "<head>\n";
        $html .= "<meta http-equiv='content-type' content='text/html; charset=utf-8' />\n";
        $html .= "<meta name='viewport' content='width=device-width, initial-scale=1.0'>\n";
        $html .= "<meta http-equiv='X-UA-Compatible' content='IE=edge'>\n";
        $html .= "<link href='/favicon.ico' rel='icon' type='image/x-icon' />\n";

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
     * Generates html/body content
     *
     * @access protected
     * @return string
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
     * Generates dynamic jquery 'ready document' code
     *
     * @access protected
     * @return string
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
     * Adds code to jquery 'ready document' string
     *
     * @param string $code
     *
     * @access public
     * @return void
     */
    public function addJS($code)
    {
        $this->js .= $code;
    }
}
