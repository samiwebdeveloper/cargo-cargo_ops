<?php


class Invoice extends CI_Controller {

	function __construct() {
    parent::__construct();
    $this->load->model('Invoicemodel');
	}

    
	public function index(){
	$data['invoice_data']=$this->Invoicemodel->Get_Invoice_Data_By_Customer_ID($_SESSION['customer_id']);	
	$this->load->view('module_report/paidView',$data);	    
	}
	
	
	public function main(){
	$data['invoice_data']=$this->Invoicemodel->Get_Invoice_Data_By_Main_ID($_SESSION['user_id']);	
	$this->load->view('module_report/paidmainView',$data);	    
	}
	
	public function invoice_detail($id){
	$data['id']=$id;    
	$invoices_data=$this->Invoicemodel->Get_Invoice_Detail_Data_By_ID($id);
	$invoice_archive_data=$this->Invoicemodel->Get_Invoice_Detail_Data_By_ID_Archive($id);
	if(!empty($invoice_archive_data)){
	$data['invoice_data']=array_merge($invoices_data,$invoice_archive_data);
	} else {
	$data['invoice_data']=$invoices_data;    
	}
	$this->load->view('module_report/paiddetailView',$data);	    
	}
    
    public function export_invoice_detail($id){
        $invoices_data=$this->Invoicemodel->Get_Invoice_Detail_Data_By_ID($id);
	$invoice_archive_data=$this->Invoicemodel->Get_Invoice_Detail_Data_By_ID_Archive($id);
	
    $invoices_data=array_merge($invoices_data,$invoice_archive_data);
	//$invoice_archive_data=$this->Invoicemodel->Get_Invoice_Detail_Data_By_ID_Archive($id);
	//if(!empty($invoice_archive_data)){
	//$invoice_data=array_merge($invoices_data,$invoice_archive_data);
	//} else {
	$invoice_data=$invoices_data;    
	//}
    if(!empty($invoice_data)){
    $i=0;    
    $this->load->library("excel");
	$object = new PHPExcel();
    $object->setActiveSheetIndex(0);
    $table_columns = array("Sr #","Consigee","Consignment Number", "Ref. No", "Weight (Kg)", "Destination" , "Origin","Pieces","CN Status","COD","Service Charges","GST","SP Handling","Cash Handling","Fuel","Net Receiveable");
				$object->getActiveSheet()->setTitle('Invoice');
			  $column = 0;

  
	foreach($table_columns as $field){
	$object->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $field);
	$column++;
	}for ($col = ord('A'); $col <= ord('Z'); $col++) {
							//set column dimension
							$object->getActiveSheet()->getColumnDimension(chr($col))->setAutoSize(true);
							$object->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
							$object->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);
							$object->getActiveSheet()->getStyle('C1')->getFont()->setBold(true);
							$object->getActiveSheet()->getStyle('D1')->getFont()->setBold(true);
							$object->getActiveSheet()->getStyle('E1')->getFont()->setBold(true);
							$object->getActiveSheet()->getStyle('F1')->getFont()->setBold(true);
							$object->getActiveSheet()->getStyle('G1')->getFont()->setBold(true);
							$object->getActiveSheet()->getStyle('H1')->getFont()->setBold(true);
							$object->getActiveSheet()->getStyle('I1')->getFont()->setBold(true);
							$object->getActiveSheet()->getStyle('J1')->getFont()->setBold(true);
							$object->getActiveSheet()->getStyle('K1')->getFont()->setBold(true);
							$object->getActiveSheet()->getStyle('L1')->getFont()->setBold(true);
							
							$object->getActiveSheet()->getStyle('M1')->getFont()->setBold(true);
							$object->getActiveSheet()->getStyle('N1')->getFont()->setBold(true);
							$object->getActiveSheet()->getStyle('O1')->getFont()->setBold(true);
							
							//change the font size
							$object->getActiveSheet()->getStyle(chr($col))->getFont()->setSize(12);
						}
						 $excel_row = 2;
                foreach($invoice_data as $row){
			    $i=$i+1;
                
			   $object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, $i);
			   $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, $row->consignee_name);
			   $object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, $row->order_code);
			   $object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, $row->customer_reference_no);
			   $object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, $row->weight );
			   $object->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row, $row->destination_city_name);
			   $object->getActiveSheet()->setCellValueByColumnAndRow(6, $excel_row, $row->origin_city_name);
			   $object->getActiveSheet()->setCellValueByColumnAndRow(7, $excel_row, $row->pieces );
			   $object->getActiveSheet()->setCellValueByColumnAndRow(8, $excel_row, $row->order_status);
			   if($row->order_status!="RTS"){
                $object->getActiveSheet()->setCellValueByColumnAndRow(9, $excel_row, $row->cod);
                } else {
                $object->getActiveSheet()->setCellValueByColumnAndRow(9, $excel_row, 0);    
                }
			   $object->getActiveSheet()->setCellValueByColumnAndRow(10, $excel_row, ($row->sc));
			   $object->getActiveSheet()->setCellValueByColumnAndRow(11, $excel_row, ($row->gst));
			   $object->getActiveSheet()->setCellValueByColumnAndRow(12, $excel_row, ($row->sp_handling));
			   $object->getActiveSheet()->setCellValueByColumnAndRow(13, $excel_row, ($row->cash_handling));
			   $object->getActiveSheet()->setCellValueByColumnAndRow(14, $excel_row, ($row->fuel));
			   if($row->order_status!="RTS"){
			   $object->getActiveSheet()->setCellValueByColumnAndRow(15, $excel_row, (($sum=$row->cod-($row->sc + $row->gst + $row->sp_handling + $row->cash_handling + $row->fuel))));      
               } else {
               $object->getActiveSheet()->setCellValueByColumnAndRow(15, $excel_row, (-($row->sc + $row->gst + $row->sp_handling + $row->cash_handling + $row->fuel)));                  
               }
               $excel_row++;
			   $i++;
            
			  }
			   		   
			  $object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel5');
			  header('Content-Type: application/vnd.ms-excel');
			  header('Content-Disposition: attachment;filename="Invoice.xls"');
			  $object_writer->save('php://output');
			  
    } 
    }
	
}
