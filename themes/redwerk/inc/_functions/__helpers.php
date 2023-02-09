<?php

function get_nav_menu($menu_name = 'header')
{
	$locations = get_nav_menu_locations();
	$navbar_items = wp_get_nav_menu_items($locations[$menu_name]);
	if (!$navbar_items || count($navbar_items) <= 0) { return; }
	$child_items = [];

	// Pull all child menu items into separate object
	foreach ($navbar_items as $key => $item) {
		if ($item->menu_item_parent) {
			array_push($child_items, $item);
			unset($navbar_items[$key]);
		}
	}

	// Push child items into their parent item in the original object
	foreach ($navbar_items as $item) {
		foreach ($child_items as $key => $child) {
			if ($child->menu_item_parent == $item->object_id) {
				if (!$item->child_items) {
					$item->child_items = [];
				}

				array_push($item->child_items, $child);
				unset($child_items[$key]);
			}
		}
	}

	// Form HTML
	$nav_menu = '<ul class="nav-menu">';
	foreach ($navbar_items as $item) {
		if ($item->child_items && count($item->child_items) > 0) {
			$nav_menu .=
			'<li class="dropdown">' .
				'<a class="dropdown-main" href="' . $item->url . '">' . $item->title . '.</a>' .
				'<ul class="dropdown-list">';
					foreach ($item->child_items as $subitem) {
						$nav_menu .= '<li><a href="' . $subitem->url . '">' . $subitem->title . '</a></li>';
					}
			$nav_menu .=
				'</ul>' .
			'</li>';
		} else {
			$nav_menu .= '<li><a href="' . $item->url . '">' . $item->title . '</a></li>';
		}
	}
	$nav_menu .= '</ul>';

	return $nav_menu;
}