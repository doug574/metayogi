<?php

$menus = array();

$menus[] = array (
  '_id' => '50080fcef311fef627000002',
  'description' => '',
  'label' => 'Admin Navbar',
  'menuitems' => 
  array (
    '0home' => 
    array (
      'method' => 'link',
      'menuitemtitle' => 'Home',
      'menuitempath' => 'admin',
    ),
    '1collect' => 
    array (
      'menuitems' => 
      array (
 
      ),
      'menuitemtitle' => 'Collect',
      'method' => 'dropdown',
    ),
    '2manage' => 
    array (
      'menuitems' => 
      array (
        0 => 
        array (
          'method' => 'link',
          'menuitemtitle' => 'Components',
          'menuitempath' => 'admin/components',
        ),
        1 => 
        array (
          'method' => 'submenu',
          'menuitemtitle' => 'Users & Permissions',
          'menuitems' => 
          array (
            0 => 
            array (
              'method' => 'link',
              'menuitemtitle' => 'Users',
              'menuitempath' => 'admin/user',
            ),
            1 => 
            array (
              'method' => 'link',
              'menuitemtitle' => 'Roles',
              'menuitempath' => 'admin/roles',
            ),
            2 => 
            array (
              'method' => 'link',
              'menuitemtitle' => 'Permissions',
              'menuitempath' => 'admin/rbacs',
            ),
          ),
        ),
        2 => 
        array (
          'method' => 'link',
          'menuitemtitle' => 'Sessions',
          'menuitempath' => 'admin/sessions',
        ),
        3 => 
        array (
          'method' => 'link',
          'menuitemtitle' => 'Caches',
          'menuitempath' => 'admin/cache',
        ),
        4 => 
        array (
          'method' => 'link',
          'menuitemtitle' => 'Reindex',
          'menuitempath' => 'admin/reindex',
        ),
      ),
      'menuitemtitle' => 'Manage',
      'method' => 'dropdown',
    ),
    '3design' => 
    array (
      'menuitems' => 
      array (
        0 => 
        array (
          'method' => 'link',
          'menuitemtitle' => 'Namespaces',
          'menuitempath' => 'admin/namespaces',
        ),
        1 => 
        array (
          'method' => 'link',
          'menuitemtitle' => 'Properties',
          'menuitempath' => 'admin/properties',
        ),
        2 => 
        array (
          'method' => 'link',
          'menuitemtitle' => 'Classes',
          'menuitempath' => 'admin/classes',
        ),
        3 => 
        array (
          'method' => 'link',
          'menuitemtitle' => 'Behaviours',
          'menuitempath' => 'admin/controllers',
        ),
      ),
      'menuitemtitle' => 'Design',
      'method' => 'dropdown',
    ),
    '4debug' => 
    array (
      'method' => 'dropdown',
      'menuitemtitle' => 'Debug',
      'menuitems' => 
      array (
      ),
    ),
    '5help' => 
    array (
      'method' => 'dropdown',
      'menuitemtitle' => 'Help',
      'menuitems' => 
      array (
        0 => 
        array (
          'method' => 'link',
          'menuitemtitle' => 'Designer Guide',
          'menuitempath' => 'admin/help/designer',
        ),
        1 => 
        array (
          'method' => 'link',
          'menuitemtitle' => 'Developer Guide',
          'menuitempath' => 'admin/help/developer',
        ),
        2 => 
        array (
          'method' => 'link',
          'menuitemtitle' => 'Administrator Guide',
          'menuitempath' => 'admin/help/administrator',
        ),
      ),
    ),
  ),
);