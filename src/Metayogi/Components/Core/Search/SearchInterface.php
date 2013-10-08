<?php
/**
 * This file is part of Metayogi.
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Metayogi\Components\Core\Search;

/**
 * Defines interface for database abstraction layer.
 *
 * @package Metayogi
 * @author  Doug Macdonald <doug.macdonald@usask.ca>
 *
 */
interface SearchInterface
{
    /**
     * Description
     *
     * @param array $config Description
     *
     * @return object
     * @access public
     */
    public function __construct($config);

    public function addDocument($dbh, $doc);
    
    public function removeDocument($recid);
    
    public function addCollection($dbh, $collection, $embed);
    
    public function removeCollection();

    public function removeAll();
    
    public function query($terms, $facets, $attrs);
}
