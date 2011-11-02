<?
  2/**
  3 * filename: ext_page.class.php
  4 * @package:phpbean
  5 * @author :feifengxlq<feifengxlq#gmail.com><[url=http://www.phpobject.net/]http://www.phpobject.net/[/url]>
  6 * @copyright :Copyright 2006 feifengxlq
  7 * @license:version 2.0
  8 * @create:2006-5-31
  9 * @modify:2006-6-1
 10 * @modify:feifengxlq 2006-11-4
 11 * description:超强分页类，四种分页模式，默认采用类似baidu,google的分页风格。
 12 * 2.0增加功能：支持自定义风格，自定义样式，同时支持PHP4和PHP5,
 13 * to see detail,please visit [url=http://www.phpobject.net/blog/read.php]http://www.phpobject.net/blog/read.php[/url]?
 14 * example:
 15 * 模式四种分页模式：
 16   require_once('../libs/classes/page.class.php');
 17   $page=new page(array('total'=>1000,'perpage'=>20));
 18   echo 'mode:1<br>'.$page->show();
 19   echo '<hr>mode:2<br>'.$page->show(2);
 20   echo '<hr>mode:3<br>'.$page->show(3);
 21   echo '<hr>mode:4<br>'.$page->show(4);
 22   开启AJAX：
 23   $ajaxpage=new page(array('total'=>1000,'perpage'=>20,'ajax'=>'ajax_page','page_name'=>'test'));
 24   echo 'mode:1<br>'.$ajaxpage->show();
 25   采用继承自定义分页显示模式：
 26   demo:http://www.phpobject.net/blog
 27 */
 28class page 
 29{
 30 /**
 31  * config ,public
 32  */
 33 var $page_name="PB_page";//page标签，用来控制url页。比如说xxx.php?PB_page=2中的PB_page
 34 var $next_page='>';//下一页
 35 var $pre_page='<';//上一页
 36 var $first_page='First';//首页
 37 var $last_page='Last';//尾页
 38 var $pre_bar='<<';//上一分页条
 39 var $next_bar='>>';//下一分页条
 40 var $format_left='[';
 41 var $format_right=']';
 42 var $is_ajax=false;//是否支持AJAX分页模式 
 43 
 44 /**
 45  * private
 46  *
 47  */ 
 48 var $pagebarnum=10;//控制记录条的个数。
 49 var $totalpage=0;//总页数
 50 var $ajax_action_name='';//AJAX动作名
 51 var $nowindex=1;//当前页
 52 var $url="";//url地址头
 53 var $offset=0;
 54 
 55 /**
 56  * constructor构造函数
 57  *
 58  * @param array $array['total'],$array['perpage'],$array['nowindex'],$array['url'],$array['ajax']
 59  */
 60 function page($array)
 61 {
 62  if(is_array($array)){
 63     if(!array_key_exists('total',$array))$this->error(__FUNCTION__,'need a param of total');
 64     $total=intval($array['total']);
 65     $perpage=(array_key_exists('perpage',$array))?intval($array['perpage']):10;
 66     $nowindex=(array_key_exists('nowindex',$array))?intval($array['nowindex']):'';
 67     $url=(array_key_exists('url',$array))?$array['url']:'';
 68  }else{
 69     $total=$array;
 70     $perpage=10;
 71     $nowindex='';
 72     $url='';
 73  }
 74  if((!is_int($total))||($total<0))$this->error(__FUNCTION__,$total.' is not a positive integer!');
 75  if((!is_int($perpage))||($perpage<=0))$this->error(__FUNCTION__,$perpage.' is not a positive integer!');
 76  if(!empty($array['page_name']))$this->set('page_name',$array['page_name']);//设置pagename
 77  $this->_set_nowindex($nowindex);//设置当前页
 78  $this->_set_url($url);//设置链接地址
 79  $this->totalpage=ceil($total/$perpage);
 80  $this->offset=($this->nowindex-1)*$this->perpage;
 81  if(!empty($array['ajax']))$this->open_ajax($array['ajax']);//打开AJAX模式
 82 }
 83 /**
 84  * 设定类中指定变量名的值，如果改变量不属于这个类，将throw一个exception
 85  *
 86  * @param string $var
 87  * @param string $value
 88  */
 89 function set($var,$value)
 90 {
 91  if(in_array($var,get_object_vars($this)))
 92     $this->$var=$value;
 93  else {
 94   $this->error(__FUNCTION__,$var." does not belong to PB_Page!");
 95  }
 96  
 97 }
 98 /**
 99  * 打开倒AJAX模式
100  *
101  * @param string $action 默认ajax触发的动作。
102  */
103 function open_ajax($action)
104 {
105  $this->is_ajax=true;
106  $this->ajax_action_name=$action;
107 }
108 /**
109  * 获取显示"下一页"的代码
110  * 
111  * @param string $style
112  * @return string
113  */
114 function next_page($style='')
115 {
116  if($this->nowindex<$this->totalpage){
117   return $this->_get_link($this->_get_url($this->nowindex+1),$this->next_page,$style);
118  }
119  return '<span class="'.$style.'">'.$this->next_page.'</span>';
120 }
121 
122 /**
123  * 获取显示“上一页”的代码
124  *
125  * @param string $style
126  * @return string
127  */
128 function pre_page($style='')
129 {
130  if($this->nowindex>1){
131   return $this->_get_link($this->_get_url($this->nowindex-1),$this->pre_page,$style);
132  }
133  return '<span class="'.$style.'">'.$this->pre_page.'</span>';
134 }
135 
136 /**
137  * 获取显示“首页”的代码
138  *
139  * @return string
140  */
141 function first_page($style='')
142 {
143  if($this->nowindex==1){
144      return '<span class="'.$style.'">'.$this->first_page.'</span>';
145  }
146  return $this->_get_link($this->_get_url(1),$this->first_page,$style);
147 }
148 
149 /**
150  * 获取显示“尾页”的代码
151  *
152  * @return string
153  */
154 function last_page($style='')
155 {
156  if($this->nowindex==$this->totalpage){
157      return '<span class="'.$style.'">'.$this->last_page.'</span>';
158  }
159  return $this->_get_link($this->_get_url($this->totalpage),$this->last_page,$style);
160 }
161 
162 function nowbar($style='',$nowindex_style='')
163 {
164  $plus=ceil($this->pagebarnum/2);
165  if($this->pagebarnum-$plus+$this->nowindex>$this->totalpage)$plus=($this->pagebarnum-$this->totalpage+$this->nowindex);
166  $begin=$this->nowindex-$plus+1;
167  $begin=($begin>=1)?$begin:1;
168  $return='';
169  for($i=$begin;$i<$begin+$this->pagebarnum;$i++)
170  {
171   if($i<=$this->totalpage){
172    if($i!=$this->nowindex)
173        $return.=$this->_get_text($this->_get_link($this->_get_url($i),$i,$style));
174    else 
175        $return.=$this->_get_text('<span class="'.$nowindex_style.'">'.$i.'</span>');
176   }else{
177    break;
178   }
179   $return.="\n";
180  }
181  unset($begin);
182  return $return;
183 }
184 /**
185  * 获取显示跳转按钮的代码
186  *
187  * @return string
188  */
189 function select()
190 {
191  $return='<select name="PB_Page_Select" >';
192  for($i=1;$i<=$this->totalpage;$i++)
193  {
194   if($i==$this->nowindex){
195    $return.='<option value="'.$i.'" selected>'.$i.'</option>';
196   }else{
197    $return.='<option value="'.$i.'">'.$i.'</option>';
198   }
199  }
200  unset($i);
201  $return.='</select>';
202  return $return;
203 }
204 
205 /**
206  * 获取mysql 语句中limit需要的值
207  *
208  * @return string
209  */
210 function offset()
211 {
212  return $this->offset;
213 }
214 
215 /**
216  * 控制分页显示风格（你可以增加相应的风格）
217  *
218  * @param int $mode
219  * @return string
220  */
221 function show($mode=1)
222 {
223  switch ($mode)
224  {
225   case '1':
226    $this->next_page='下一页';
227    $this->pre_page='上一页';
228    return $this->pre_page().$this->nowbar().$this->next_page().'第'.$this->select().'页';
229    break;
230   case '2':
231    $this->next_page='下一页';
232    $this->pre_page='上一页';
233    $this->first_page='首页';
234    $this->last_page='尾页';
235    return $this->first_page().$this->pre_page().'[第'.$this->nowindex.'页]'.$this->next_page().$this->last_page().'第'.$this->select().'页';
236    break;
237   case '3':
238    $this->next_page='下一页';
239    $this->pre_page='上一页';
240    $this->first_page='首页';
241    $this->last_page='尾页';
242    return $this->first_page().$this->pre_page().$this->next_page().$this->last_page();
243    break;
244   case '4':
245    $this->next_page='下一页';
246    $this->pre_page='上一页';
247    return $this->pre_page().$this->nowbar().$this->next_page();
248    break;
249   case '5':
250    return $this->pre_bar().$this->pre_page().$this->nowbar().$this->next_page().$this->next_bar();
251    break;
252  }
253  
254 }
255/*----------------private function (私有方法)-----------------------------------------------------------*/
256 /**
257  * 设置url头地址
258  * @param: String $url
259  * @return boolean
260  */
261 function _set_url($url="")
262 {
263  if(!empty($url)){
264      //手动设置
265   $this->url=$url.((stristr($url,'?'))?'&':'?').$this->page_name."=";
266  }else{
267      //自动获取
268   if(empty($_SERVER['QUERY_STRING'])){
269       //不存在QUERY_STRING时
270    $this->url=$_SERVER['REQUEST_URI']."?".$this->page_name."=";
271   }else{
272       //
273    if(stristr($_SERVER['QUERY_STRING'],$this->page_name.'=')){
274        //地址存在页面参数
275     $this->url=str_replace($this->page_name.'='.$this->nowindex,'',$_SERVER['REQUEST_URI']);
276     $last=$this->url[strlen($this->url)-1];
277     if($last=='?'||$last=='&'){
278         $this->url.=$this->page_name."=";
279     }else{
280         $this->url.='&'.$this->page_name."=";
281     }
282    }else{
283        //
284     $this->url=$_SERVER['REQUEST_URI'].'&'.$this->page_name.'=';
285    }//end if    
286   }//end if
287  }//end if
288 }
289 
290 /**
291  * 设置当前页面
292  *
293  */
294 function _set_nowindex($nowindex)
295 {
296  if(empty($nowindex)){
297   //系统获取
298   
299   if(isset($_GET[$this->page_name])){
300    $this->nowindex=intval($_GET[$this->page_name]);
301   }
302  }else{
303      //手动设置
304   $this->nowindex=intval($nowindex);
305  }
306 }
307  
308 /**
309  * 为指定的页面返回地址值
310  *
311  * @param int $pageno
312  * @return string $url
313  */
314 function _get_url($pageno=1)
315 {
316  return $this->url.$pageno;
317 }
318 
319 /**
320  * 获取分页显示文字，比如说默认情况下_get_text('<a href="">1</a>')将返回[<a href="">1</a>]
321  *
322  * @param String $str
323  * @return string $url
324  */ 
325 function _get_text($str)
326 {
327  return $this->format_left.$str.$this->format_right;
328 }
329 
330 /**
331   * 获取链接地址
332 */
333 function _get_link($url,$text,$style=''){
334  $style=(empty($style))?'':'class="'.$style.'"';
335  if($this->is_ajax){
336      //如果是使用AJAX模式
337   return '<a '.$style.' href="javascript:'.$this->ajax_action_name.'(\''.$url.'\')">'.$text.'</a>';
338  }else{
339   return '<a '.$style.' href="'.$url.'">'.$text.'</a>';
340  }
341 }
342 /**
343   * 出错处理方式
344 */
345 function error($function,$errormsg)
346 {
347     die('Error in file <b>'.__FILE__.'</b> ,Function <b>'.$function.'()</b> :'.$errormsg);
348 }
349}
350?>