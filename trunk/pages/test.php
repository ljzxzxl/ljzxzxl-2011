<?
 2require_once('../libs/classes/page.class.php');
 3$page=new page(array('total'=>1000,'perpage'=>20));
 4echo 'mode:1<br>'.$page->show();
 5echo '<hr>mode:2<br>'.$page->show(2);
 6echo '<hr>mode:3<br>'.$page->show(3);
 7echo '<hr>mode:4<br>'.$page->show(4);
 8echo '<hr>开始AJAX模式:';
 9$ajaxpage=new page(array('total'=>1000,'perpage'=>20,'ajax'=>'ajax_page','page_name'=>'test'));
10echo 'mode:1<br>'.$ajaxpage->show();
11?>