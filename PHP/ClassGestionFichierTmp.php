<?php
	include_once 'ClassClient.php';

	//création de l'objet PHP Client
    class GestionFichierTmp
	{

		const VALIDACTIONS = array("Create", "Read", "Update", "Delete");
		
		function __call($name_of_function, $arguments) 
		{
			if($name_of_function == 'UpdateTmpFile') 
			{
              
				switch (count($arguments)) {
					case 1:
						if($this->IsActionValid($arguments[0]))
						{
							if($arguments[0]=="Read"){
								$this->AddLine("Récupération de la liste des clients.");
							}
						}
						break;
					case 2:
						if($this->IsActionValid($arguments[0]) && $this->IsClientValid($arguments[1]))
						{
							switch($arguments[0])
							{
								case "Create" :
									$tmpText="Création du client ".$arguments[1]->Get_NCLI()." ".$arguments[1]->Get_NOM();
									$this->AddLine($tmpText);
									break;
								case "Update" :
									$tmpText="Modification du client ".$arguments[1]->Get_NCLI()." ".$arguments[1]->Get_NOM();
									$this->AddLine($tmpText);
									break;
								case "Delete" :
									$tmpText="Suppression du client ".$arguments[1]->Get_NCLI()." ".$arguments[1]->Get_NOM();
									$this->AddLine($tmpText);
									break;
							}
						}
						break;
				}
			}
		}

		private function IsActionValid($action)
		{
			if(is_string($action))
			{
				if(in_array($action, self::VALIDACTIONS))
				{
					return true;
				}
				else
				{
					return false;
				}
			}
			else
			{
				return false;
			}
		}

		private function IsClientValid($client)
		{
			if(gettype($client)==gettype(new Client())){
				if(get_class($client)!="Client")
				{
					return false;
				}
				else
				{
					return true;
				}
			}
			else
			{
				return false;
			}	
		}

		private  function AddLine($text)
		{
			$fileName="../tmp/Journal_".date("d_m_Y").".tmp";
			$myfile = fopen($fileName, "a") or die("Unable to open file!");
			fclose($myfile);
			$fileContent = file_get_contents ($fileName);
			$newLine = "Le ".date("d m Y");
			$newLine = $newLine." à ".date("H:i");
			$newLine = $newLine." : ".$text;
			$newLine = mb_convert_encoding($newLine, 'UTF-8', 'OLD-ENCODING');
			file_put_contents ($fileName, $newLine . "\n" . $fileContent);
		}
	}	

?>