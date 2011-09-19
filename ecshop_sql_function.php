<?php

//Ecshop getAll() 函数使用

//函数构造
function get_ad_info_list()
{
    $sql = "SELECT * FROM " .$GLOBALS['ecs']->table('ad'). " WHERE position_id = '0'";
    $arr = array();
    $res = $GLOBALS['db']->getAll($sql);
	foreach ($res AS $row)
    {
		$arr[] = array('ad_id'         => $row['ad_id'],
					   'ad_name'       => $row['ad_name'],
					   'ad_link'       => $row['ad_link'],
                       'ad_code'       => $row['ad_code']);
	}
    return $arr;
}
//smarty传递数组到页面
elseif ($action == 'promotion')
{
    include_once(ROOT_PATH .'includes/lib_transaction.php');

    $ad_info_list = get_ad_info_list();

    $smarty->assign('ad_info_list', $ad_info_list);
    $smarty->display('user_transaction.dwt');
}
//页面调用数据
<!-- {foreach from=$ad_info_list item=item} -->
	{$item.ad_id}
	{$item.ad_name}
	{$item.ad_link}
	{$item.ad_code}
<!-- {/foreach} -->


//Ecshop getRow() 函数使用

//函数构造
function count_promotion_profit($user_id)
{
	$sql = "SELECT SUM(valid_order) AS sum_valid_order,SUM(no_postage) AS sum_no_postage FROM " .$GLOBALS['ecs']->table('ad_promotion'). " WHERE promotion_user_id = '" .$user_id. "'";
    $sum = array();
	$sum = $GLOBALS['db']->getRow($sql);
	//计算当前用户的推广结余
	$count = intval($sum['sum_valid_order']) - intval($sum['sum_no_postage']);
	//兑换成的现金数
	$change_rmb = 5*$count;
	$sql = "SELECT COUNT(*) FROM " .$GLOBALS['ecs']->table('ad_promotion'). " WHERE promotion_user_id = '" .$user_id. "'";
	//获得当前用户的推广用户总数
	$sum_user = $GLOBALS['db']->getOne($sql);
	
	$profit_data = array();
	$profit_data = array('sum_user'  	=> $sum_user,
						'count'     	=> $count,
						'change_rmb'	=> $change_rmb);
    return $profit_data;
}
//smarty传递数组到页面
	$profit_data  = count_promotion_profit($_SESSION['user_id']);
	$smarty->assign('profit_data', $profit_data);
//页面调用数据
{$profit_data.sum_user}
{$profit_data.count}
{$profit_data.change_rmb}

?>