<?php
class KekhaitaisanControllerTaisan extends JControllerLegacy {
	function __construct() {
		parent::__construct ();
	}
	function display($cachable = false, $urlparams = false) {
		parent::display();
	}
	function edit() {
		$id = ( int ) JRequest::getInt ( 'id', 0 );
		$data = array ();
		if ($id > 0) {
			$model = Core::model('Kekhaitaisan/KktsTaisan');
			$data = $model->read ( $id );
		}
		JRequest::setVar ( 'data', $data );
		JRequest::setVar ( 'view', 'Taisan' );
		JRequest::setVar ( 'layout', 'form' );
		parent::display ();
	}
	function cancel() {
		JRequest::checkToken () or jexit ( 'Invalid Token' );
		$msg = JText::_ ( 'Hoạt động đã hủy bỏ' );
		$this->setRedirect ( 'index.php?option=com_kekhaitaisan&controller=taisan', $msg );
	}
	function save() {
		$formData = JRequest::get ( 'post' );
		$id = JRequest::getVar ( 'id' );
		$model = Core::model('Kekhaitaisan/KktsTaisan');
		if ($id > 0) {
				if ($model->update ( $formData )) {
					$msg = JText::_ ( 'Cập nhật thành công!' );
				} else {
					$msg = JText::_ ( 'Lỗi!' );
				}
		} else {
				if ($model->create ( $formData )) {
					$msg = JText::_ ( 'Thêm mới thành công!' );
				} else {
					$msg = JText::_ ( 'Lỗi!' );
				}
		}
		$link = 'index.php?option=com_kekhaitaisan&controller=taisan';
		$this->setRedirect ( $link, $msg );
	}
	function remove() {
		$cid = JRequest::getVar ( 'cid', array (), 'post', 'array' );
		JArrayHelper::toInteger ( $cid );
		if (count ( $cid ) < 1) {
			JError::raiseError ( 500, JText::_ ( 'Chọn ít nhất một mục để xóa' ) );
		} else {
			$msg = 'Đã xóa thành công';
			$model = Core::model('Kekhaitaisan/KktsTaisan');
			if (! $model->delete ( $cid )) {
				$msg = 'Lỗi không xóa được';
			}
		}
		$link = 'index.php?option=com_kekhaitaisan&controller=taisan';
		$this->setRedirect ( $link );
	}
	function publish() {
		$cid = JRequest::getVar ( 'cid', array (), 'post', 'array' );
		JArrayHelper::toInteger ( $cid );
		if (count ( $cid ) < 1) {
			JError::raiseError ( 500, JText::_ ( 'Chọn ít nhất một mục' ) );
		} else {
			$model = Core::model('Kekhaitaisan/KktsTaisan');
			$msg = 'Cập nhật thành công';
			if (! $model->publish ( $cid, 1 )) {
				$msg = 'Lỗi cập nhật';
			}
		}
		$link = 'index.php?option=com_kekhaitaisan&controller=taisan';
		$this->setRedirect ( $link );
	}
	function unpublish() {
		$cid = JRequest::getVar ( 'cid', array (), 'post', 'array' );
		JArrayHelper::toInteger ( $cid );
		if (count ( $cid ) < 1) {
			JError::raiseError ( 500, JText::_ ( 'Chọn ít nhất một mục' ) );
		} else {
			$model = Core::model('Kekhaitaisan/KktsTaisan');
			$msg = 'Cập nhật thành công';
			if (! $model->publish ( $cid, 0 )) {
				$msg = 'Lỗi cập nhật';
			}
		}
		$link = 'index.php?option=com_kekhaitaisan&controller=taisan';
		$this->setRedirect ( $link );
	}
}
?>