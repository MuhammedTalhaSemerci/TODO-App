<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class todoList extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */


	public function index()
	{
		$this->load->database(); // That opens a pdo connection to database.
		$this->load->model("todoListModel"); // It reaches to the modal.
		$data['todoList'] = $this->todoListModel->getList();
		$this->load->view('todoListView',$data); // Loads a view file
	}

	public function insert()
	{
		$this->load->database();
		$this->load->model("todoListModel");
		if($this->input->post("listName") !== "" && $this->input->post("listStress")!== "")
		{
			$listName = $this->input->post("listName");
			$listDate = ($this->input->post("listDate")!== "")? $this->input->post("listDate"):null;
			$listContent = ($this->input->post("listContent")!== "")? $this->input->post("listContent"):null;
			$listStress = $this->input->post("listStress");
			$listKeywords = ($this->input->post("listKeywords") !== "")? json_encode(explode(",",str_replace("\n",",",$this->input->post("listKeywords"))),JSON_UNESCAPED_UNICODE):null;

			$search = $this->todoListModel->searchTitle($listName);
			if(count($search)>0)
			{
				echo 2;
				return;
			}
			$data = array(
				"listName" => $listName, 
				"listDate" => $listDate,
				"listContent"=>$listContent, 
				"listStress" => intval($listStress),
				"listKeywords" => $listKeywords
			);

			$result = $this->todoListModel->insert($data);
			echo $result;
		}
		else
		{
			echo 0;
		}
		
	}

	public function update()
	{
		$this->load->database();
		$this->load->model("todoListModel");
		if($this->input->post("index") !== "" && $this->input->post("listName") !== "" && $this->input->post("listStress")!== "")
		{
			$index = $this->input->post("index");
			$listName = $this->input->post("listName");
			$listDate = ($this->input->post("listDate")!== "")? $this->input->post("listDate"):null;
			$listContent = ($this->input->post("listContent")!== "")? $this->input->post("listContent"):null;
			$listStress = $this->input->post("listStress");
			$listKeywords = ($this->input->post("listKeywords") !== "")? json_encode(explode(",",str_replace("\n",",",$this->input->post("listKeywords"))),JSON_UNESCAPED_UNICODE):null;

			$search = $this->todoListModel->searchTitle($listName);
			if(count($search) > 0)
			{
				for($i=0;$i<count($search);$i++)
				{
					if($search[$i]->{"id"} != $index)
					{
						echo 2;
						return;
					}
					else
					{
						continue;
					}
				}
			}
			$where = array("id" => $index);
			$result = $this->todoListModel->update($listName,$listDate,$listContent,$listStress,$listKeywords,$where);
			echo $result;
		}
		else
		{
			echo 0;
		}
	}

	public function delete()
	{
		$this->load->database();
		$this->load->model("todoListModel");
		if($this->input->post("index") !== "")
		{
			$index = $this->input->post("index");
			$where = array("id" => $index);
			$result = $this->todoListModel->delete($where);
			echo $result;
		}
	}


	public function refresh()
	{
		$this->load->database(); // That opens a pdo connection to database.
		$this->load->model("todoListModel"); // It reaches to the modal.
		$data = $this->todoListModel->getList();
		echo json_encode($data,JSON_UNESCAPED_UNICODE);
	}
	public function search()
	{
		$this->load->database(); // That opens a pdo connection to database.
		$this->load->model("todoListModel"); // It reaches to the modal.
		if($this->input->post("search") !== "")
		{
			$search = $this->input->post("search");
			$result = $this->todoListModel->search($search);
			echo json_encode($result,JSON_UNESCAPED_UNICODE);
		}
		else
		{
			echo 0;
		}
	}
	public function getOne()
	{
		$this->load->database(); // That opens a pdo connection to database.
		$this->load->model("todoListModel"); // It reaches to the modal.
		if($this->input->post("index") !== "")
		{
			$index = $this->input->post("index");
			$data = array("id" => $index);
			$result = $this->todoListModel->getOne($data);
			echo json_encode($result,JSON_UNESCAPED_UNICODE);
		}
		else
		{
			echo 0;
		}
	}

	public function reLocate()
	{
		$this->load->database(); // That opens a pdo connection to database.
		$this->load->model("todoListModel"); // It reaches to the modal.
		if($this->input->post("index1") !== "" && $this->input->post("index2") !== "")
		{
			/*Getting the infos of every indexes */
			$index1 = $this->input->post("index1");
			$index2 = $this->input->post("index2");
			$data1 = array("id" => $index1);
			$data2 = array("id" => $index2);
			$index1Info = $this->todoListModel->getOne($data1);
			$index2Info = $this->todoListModel->getOne($data2);

			/*setting the infos of every indexes */
			$result2 = $this->todoListModel->update(null,null,null,null,null,$data1);
			$result1 = $this->todoListModel->update($index1Info[0]->{"listName"},$index1Info[0]->{"listDate"},$index1Info[0]->{"listContent"},$index1Info[0]->{"listStress"},$index1Info[0]->{"listKeywords"},$data2);
			$result2 = $this->todoListModel->update($index2Info[0]->{"listName"},$index2Info[0]->{"listDate"},$index2Info[0]->{"listContent"},$index2Info[0]->{"listStress"},$index2Info[0]->{"listKeywords"},$data1);
			if($result1 == "1" && $result2 == "1")
			{
				echo 1;
			}
			else
			{
				echo 0;
			}
		}
		else
		{
			echo 0;
		}
	}

}
