<?php


namespace Core\helper;

class TransformPriceInNumber{


	public function transform(string $price)
	{

        $a = explode("R$", $price)[1];

    	return (float) str_replace(',', '.', $a);

	}


}