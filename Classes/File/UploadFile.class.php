
<?php

/**
 * Created by PhpStorm.
 * User: BRUNET Jean-Philippe
 * Date: 05/01/2017
 * Time: 14:48
 */
class UploadFile
{
    /**
     * @desc Tableau de stockage des tymes MIMES autorisés pour l'upload
     * @var array $mimes
     */
    private $mimes = array();

    /**
     * @desc Nom du champ concerné par l'application
     * @var string $fieldName
     */
    private $fieldName;

    /**
     * @desc Stocke le chemin du dossier d'uppload
     * @var string $uploadPath
     */
    protected $uploadPath;

    /**
     * UploadFile constructor.
     * @desc Instancie un nouvel objet de gestion d'upload
     * @param string $fieldName => Nom du champ à traiter pour l'upload des fichiers
     */
    public function __construct($fieldName)
    {
        $this->fieldName = $fieldName;
        $this->uploadPath = "/labo-formation-dl/Agenda/_uploads/";
    }

    /**
     * @desc Ajoute un type MIME à la liste des types MIMES à autoriser
     * @param string | array $mimeType
     * @return $this \uploadFile
     */
    public function addMime($mimeType){
        if(is_array($mimeType)){
            $this->mimes = $mimeType;
        } else {
            // y-a-t-il un / dans le mime qui a été passé ?
            if(strpos($mimeType, "/")){
                if(!in_array($mimeType,$this->mimes)){
                    $this->mimes[] = $mimeType;
                }
            } else {
                switch (strtolower($mimeType)){
                    case "image":
                    case "images":
                        $this->mimes = array(
                            "image/jpeg",
                            "image/png",
                            "image/gif"
                        );
                        break;
                    case "office":
                        $this->mimes = array(
                            "application/msword",
                            "application/vnd.openxmlformats-officedocument.wordprocessinggml.document",
                            "application/vnd.oasis.opendocument.text",
                            "application/text",
                            "application/pdf"
                        );
                        break;
                    case "video":
                    case "videos";
                        $this->mimes = array(
                            "video/*"
                        );
                        break;
                }
            }
        }
        return $this;
    }

    /**
     * @desc => Traite l'upload du fichier proprement dit et retourne le chemin vers le fichier si tout est ok, ou null sinon
     * @return string
     */
    public function process(){
        echo $_SERVER["PHP_SELF"];
        if(array_key_exists($this->fieldName, $_FILES)){
            // Ca signifie qu'un fichier a été transmis à partir du champ de formulaire
            // identifié par $this->fieldName
            $tmpName = $_FILES[$this->fieldName]["tmp_name"];
            if($tmpName != ""){
                // c'est bon on peut continuer
                if($this->mimeAuthorized($tmpName)){
                    $newName = $this->checkName($this->uploadPath . $_FILES[$this->fieldName]['name']);
                    // Le type MIME est autorisé, on peut continuer
                    if($_FILES[$this->fieldName]['error'] == UPLOAD_ERR_OK){
                        // Calcul le chemin relatif du dossier (..)/upload/ici

                        move_uploaded_file($tmpName, $this->uploadPath . $newName);
                        return $this->uploadPath . $newName;
                    }
                }
            }
        }
    }

    /**
     * @desc Retourne vrai
     * @param string $tempName
     * @return bool
     */
    protected function mimeAuthorized($tempName){
        $mimType = mime_content_type($tempName);
        return in_array($mimType, $this->mimes);
    }


    /**
     * @param $fileName
     * @return string $newFileName
     */
    protected function checkName($fileName){
        if(file_exists($this->uploadPath . $fileName)){
            if(strpos($fileName, ".") !== false){
                if(function_exists("pathinfo")){
                    $extension = pathinfo($fileName, PATHINFO_EXTENSION);
                    $fileName = pathinfo($fileName, PATHINFO_FILENAME);
                    $indice = 1 ;
                    $newFileName = $fileName . "[" . $indice . "]." . $extension;
                    while (file_exists($newFileName)){
                        $indice++;
                        $newFileName = $fileName . "[" . $indice . "]." . $extension;
                    }
                    $fileName = $newFileName;
                }
            }
        }
        return $fileName;
    }
}