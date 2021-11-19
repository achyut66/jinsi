<?php
require_once("includes/initialize.php");
 $res = array();
 $category      = $_POST['category']; 
 $item_id       = $_POST['item_id'];
 $counter       = $_POST['counter'];
 $item_stock    = ItemStock::find_item_stock($item_id, $category);
 $prev_stock = '';
 $rate_html = '';
 $qty_html = '';
 if(!empty($item_stock))
  {
    if(count($item_stock)>1)
    {
        $rate_html .= '<select id="rate_selected-'.$counter.'" name="rate_hastantaran[]" required>';
        $rate_html .='<option value="">----</option>';
       foreach($item_stock as $stock):
           if(empty($stock->stock)){ continue; }
           $rate_html .='<option value="'.$stock->rate.'">'.$stock->rate.'</option>';
       endforeach;
       $rate_html .='</select>';    
    }
    if(count($item_stock)==1)
    {
        $rate_html .= '<select name="rate_hastantaran[]" id="rate_selected-'.$counter.'"><option value="">------</option><option value="'.$item_stock[0]->rate.'">'.$item_stock[0]->rate.'</option></select>';
        $prev_stock .= $item_stock[0]->stock;
     }
    
  }
  
    if($category==1)
        {
           
            $data = Spentitem::find_by_id($item_id);
			
        }
        else
        {
            $data = Notspentitem::find_by_id($item_id);
        }
        $html = $data->specification;
        $html1 = $data->id;
        $html2 = Unit::getName($data->unit_id);
        $res['html'] = $html;
        $res['html1'] = $html1;
        $res['html2'] = $html2;
        $res['rate_html'] = $rate_html;
        $res['prev_stock'] = $prev_stock;
        $res['qty_html'] = $qty_html;
        echo json_encode($res); exit;