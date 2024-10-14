<?php
declare(strict_types=1);

require_once("Position.php");
require_once("errors.php");

class Event{
    //propiedades
    private int $idEvento;
    private string $title;
    private string $url;
    private string $type;
    private string $firstPerformerImage;
    private array $positions;

    //metodos
    public function __construct(int $id,string $title,string $url,
        string $type,string $firstPerformerImage,array $array
    ){
        //datos del evento
        $this->idEvento = $id;
        $this->title = $title;
        $this->url = $url;
        $this->type = $type;
        $this->firstPerformerImage = $firstPerformerImage;
        
        //inicializar positions (datos de tickets)
        $this->initPositionsSorted($array);
    }

    public function getEventData(): array
    {
        $eventData = get_object_vars($this);
        //array position tiene sus propios metodos de acceso
        array_pop($eventData);
        return $eventData;
    }

    public function addPosition(Position $position){
        $this->positions[] = $position;
    }

    private function addSortPosition(Position $position){
        foreach($this->positions as $key => $value){
            //si es menor se coloca delante
            if($position->sectorRowCompare($value) < 0){
                $this->insertPosition($key,$position);
                return;
            }
        }
        
        $this->addPosition($position);
    }

    private function addSortPrice(Position $position){
        $positionData = $position->getData();
        
        foreach($this->positions as $key => $value){
            $valueData = $value->getData();
            
            //si es menor se coloca delante
            if($positionData["cost"] <  $valueData["cost"]){
                $this->insertPosition($key,$position);
                return;
            }
        }
        
        $this->addPosition($position);
    }

    public function initPositionsSorted(array $array){
        $this->clearPositions();
        foreach($array as $key => $value){
            $position = new Position($array[$key]["idPosition"],$array[$key]["section"]
                ,$array[$key]["row"],$array[$key]["ticketCount"],$array[$key]["cost"])
            ;
            $this->addSortPosition($position);
        }
    }

    public function sortByPrice(){
        $positionsCopy = $this->positions;
        $this->clearPositions();
        
        foreach($positionsCopy as $key => $position){
            $this->addSortPrice($position);
        }
    }

    public function sortBySectorRow(){
        $positionsCopy = $this->positions;
        $this->clearPositions();
        
        foreach($positionsCopy as $key => $position){
            $this->addSortPosition($position);
        }
    }

    public function insertPosition(int $index, Position $value){
        checkIndexInArray($index,$this->positions);
        
        if($index==0){
            array_unshift($this->positions,$value);
            return;
        }
        
        for($i=$this->lengthPositions();$i>$index;$i--){
            $this->positions[$i]=$this->positions[$i-1];
        }
        $this->positions[$index]=$value;
    }

    public function getPosition(int $index){
        checkIndexInArray($index,$this->positions);
        return $this->positions[$index];
    }

    public function clearPositions(){
        $this->positions = [];
    }

    public function lengthPositions():int{
        return count($this->positions);
    }
};
?>