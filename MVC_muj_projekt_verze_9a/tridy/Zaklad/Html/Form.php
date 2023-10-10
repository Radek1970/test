<?php

namespace Zaklad\Html;


class Form
{
    public $akce;
    public $metoda;
    public $id;
    public $popis;
    public $type;
    public $name;
    public $hodnota;



    public function __construct(string $akce, string $metoda, string $id,)
    {
        $this->akce = $akce;
        $this->metoda = $metoda;
        $this->id = $id; //return dotazPredOdeslanim(this);
    }

    public function test(): void
    {
        echo ('Formulář');
    }



    public function form(): void
    {   //echo('<form action="'.$this->akce.'" method="'.$this->metoda.'"   id="'.$this->id.'"">');
        echo ('<form method="' . $this->metoda . '" action="' . $this->akce . '" onsubmit="' . $this->id . '">');
    }


    public function Input_pole($popis, $type, $name, $hodnota): void
    {
        $this->popis = $popis;
        $this->type = $type;
        $this->name = $name;
        $this->hodnota = $hodnota;

        if (empty($hodnota)) {
            $hodnota = (isset($_POST[$this->name])) ? $_POST[$this->name] : '';
        } else {
            $hodnota = $this->hodnota;
        }

        if ($this->type == 'textarea') {
            echo ('' . $this->id . '<label>' . $this->popis . '<br /> <textarea name="' . $this->name . '" rows="4" cols="50">' . htmlspecialchars($hodnota) . '</textarea></label><br />');
        } else {

            //echo(''.$this->id .'<label>'. $this->popis .'<br /> <input type="'.$this->type.'" name="'.$this->name.'"  value="'. $this->hodnota .'" /></label><br /> ');
            echo ('' . $this->id . '<label>' . $this->popis . '<br /> <input type="' . $this->type . '" name="' . $this->name . '"  value="' . htmlspecialchars($hodnota) . '" /></label><br />');
        }
    }


    public function button($nazev, $hodnota): void
    {
        echo ('<br><input type="submit" name="' . $nazev . '" value="' . $hodnota . '" /></form>');
    }
}
