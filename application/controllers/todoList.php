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

			$search = $this->todoListModel->searchTitle($listName);
			if(count($search)>0)
			{
				echo 2;
				return;
			}
			$data = array("listName" => $listName, "listDate" => $listDate,"listContent"=>$listContent, "listStress" => intval($listStress));
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
			$result = $this->todoListModel->update($listName,$listDate,$listContent,$listStress,$where);
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
}
