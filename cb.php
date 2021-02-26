<?php

include './cb_generator.php';

class Credit_Card {
    static function verification($digits)
    {
        $arr = str_split($digits);
        $somme = 0;

        foreach ($arr as $index => $num) {
            // cas index pair
            if ($index % 2 === 0) {
                $num = $num * 2;
                if ($num > 9) {
                    $num = $num - 9;
                }
                $somme += $num;
            }
            //cas index impair
            else {
                $somme += $num;
            }
        }

        if ($somme % 10 === 0) {
            return "Carte Valide !";
        } else {
            return "Carte Invalide !";
        }
    }

    static function banque($digits)
    {
        static $banques_array  = array(
            "34" => "American Express",
            "37" => "American Express",
            "4" => "Visa",
            "51" => "MasterCard",
            "52" => "MasterCard",
            "53" => "MasterCard",
            "54" => "MasterCard",
            "55" => "MasterCard",
            "36" => "Diner's Club",
            "38" => "Diner's Club",
            "6011" => "Discover",
            "65" => "Discover",
            "35" => "Japan Credit Bureau"
        );

        $arr = str_split($digits);
        $ref = "";
        $banqueName = "No bank found";

        for ($i = 0; $i < 4; $i++) {
            $ref .= $arr[$i];

            if (array_key_exists($ref, $banques_array)) {
                $banqueName = $banques_array[$ref];
            }
        }
        return $banqueName;
    }

    static function industrie($digit)
    {
        static $industries = array(
            "1" => "Compagnies aériennes",
            "2" => "Compagnies aériennes",
            "3" => "Voyages et loisirs",
            "4" => "Banques et finances",
            "5" => "Banques et finances",
            "6" => "Merchandising",
            "7" => "Pétrole",
            "8" => "Télécommunication",
            "9" => "Support nationaux"
        );
        return $industries[$digit];
    }

    public function __construct($card_numbers)
    {

        

        $this->card_numbers = $card_numbers;

        if (is_numeric($card_numbers)) {
            $this->status = "Valid format";

            $this->industry = Credit_Card::industrie($card_numbers[0]);
            $this->banqueName = Credit_Card::banque($this->card_numbers);
            $this->card_valid = Credit_Card::verification($this->card_numbers);
        }
        else {
            $this->status = "Invalid format";
        }
    }

    function display_card_infos()
    {
        echo "Type d'industrie : " . $this->industry;
        echo "\n";
        echo "Banque : " . $this->banqueName;
        echo "\n";
        echo "Status de la carte bancaire : " . $this->card_valid;
        echo "\n";
    }

}

// $cb = "4417123456789113";
// $test = new Credit_Card($cb);
// $test->display_card_infos();

/**
 * Générator
 */
$limit = 100;
$card_generator = generator($limit);
$sum = 0;

foreach ($card_generator as $card) {
    $new_card = new Credit_Card($card);
    if ($new_card->card_valid === "Carte Valide !") {
        echo "------------- \n";
        echo "Nouvelle carte valide : " . $card . "\n\n";
        $new_card->display_card_infos();
        $sum += 1;
    }
}

echo $sum . " / " . strval($limit) . " are valid.";
