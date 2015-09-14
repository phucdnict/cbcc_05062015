<?php
// CAC FUNCTION CO KY HIEU LJ O CUOI YEU CAU PHAI CO LEFT JOIN TUONG UNG
class Baocaothongke_Model_Share extends JModelLegacy
{	
	/**
	 * 
	 * @param String $id =>'iddv|ins_dept|tendv|exp_level|type'
	 * @return array(iddv,ins_dept,tendv,exp_level,type)
	 */
	function getDvInfo($id){
		
		$rawdata = explode('|', $id);			
		
		$data['iddv']		=	$rawdata[0];
		$data['ins_dept']	=	$rawdata[1];
// 		$data['loaihinh'] 	=	$rawdata[1];
		$data['tendv'] 		=	$rawdata[2];
		$data['exp_level']	=	$rawdata[3];
		$data['type']		=	$rawdata[4];
		return $data; 
	}

	/**
	 * Thiết lập thông tin cho 1 đơn vị
	 * @param integer $i
	 * @param integer $id
	 * @param integer $ins_dept
	 * @param string $name
	 * @param integer $exp
	 * @param integer $type
	 * @param integer $stt
	 * @param string $query
	 * @param integer $loaihinh
	 * @return number
	 */
	function setDonviInfo($i, $id, $ins_dept, $name, $exp,$type, $stt, $query, $loaihinh = null){
		$listDv[$i]['iddv'] 		= $id;
// 		$listDv[$i]['loaihinh'] = $loaihinh;
		$listDv[$i]['ins_dept']		= $ins_dept;
		$listDv[$i]['tendv'] 		= $name;
		$listDv[$i]['exp_level'] 	= $exp;
		$listDv[$i]['type'] 		= $type;
		$listDv[$i]['stt'] 			= $stt;
		$listDv[$i]['query'] 		= $query;
		$listDv[$i]['loaihinh'] 	= (int)$loaihinh;
		return $listDv[$i];	
	}	
	
	/**
	 * Lay danh sach cac to chuc co trong checkbox submit len
	 * @param null
	 */
	function _getListTochuc(){
		$this->listDv = array(); //Reset danh sach cac to chuc
		$this->_i = 0;
	
		foreach ($this->_ids[0] as $id){
				
			$dvInfo = $this->shareModel->getDvInfo($id);
			$this->shareModel->setDonviInfo($this->_i, $dvInfo['iddv'], $dvInfo['ins_dept'], $dvInfo['tendv'], $dvInfo['exp_level'], $dvInfo['type']);
// 			$this->shareModel->setDonviInfo($this->_i, $dvInfo['iddv'], $dvInfo['loaihinh'], $dvInfo['tendv'], $dvInfo['exp_level'], $dvInfo['type']);
	
			$this->_i++;
		}
	}	
		

}

