<?php

/* classe TFilter 
esta classe prove a interface para definição de filtros de seleção */

class TFilter extends TExpression{
    private $variable; // variavel
    private $operator; // operator
    private $value; // valor

    /* Método_construct()
    instancia um nono filtro
    @param $variable = variavel
    @param $operator = operador (>,<)
    @param = $value = valor a ser comparado */

    public function __construct($variable, $operator, $value){
        $this->variable = $variable;
        $this->operator = $operator;
        $this->value = $value;

        //transforma o valor de acordo com certas regras 
        // antes de atribuir a propriedade $this -> value
        
        $this->value = $this->transform($value);
}

    /* metodo transform()
    recebe um valor e faz as modificações necessarias 
    para ele ser inplementado pelo banco de dados
    podendo ser um integer/string/boolean/array
    @param $value = valor a ser transformado */

    private function transform($value)
    {
    //caso seja um array
    if(is_array($value))
    {
        //percorre os valores 
        foreach($value as $x)
        {
            //se for um inteiro
            if(is_integer($x))
            {
                $foo[0] = $x;
            }
            else if(is_string($x))
            {
                // se for string adiciona aspas
                $foo[] ="'$x'";
            }
        }
    // converte o array em string separada por ","

    $result = '('.implode(',', $foo).')';
    // caso seja uma string 
    }

    else if(is_string($value))
    {
        // adiciona aspas
        $result = "$value";
    }

    // caso seja um valor nulo
    else if(is_null($value))
    {
        // armazena nulo
        $result = 'NULL';
    }

    // caso seja um booleano

    else if(is_bool($value))
    {
        // armazena TRUE ou FALSE
        $result = $value ?'true':'false';
    }

    else 
    {
        $result = $value;
    }

    //retorna o valor
    return $result; 
}

/* metodo dump()
    retorna o filtro em forma de expressao
    */
    public function dump()
    {
    // concatena a expressao

    return "{$this->variable} {$this->operator} {$this->value}";
    }
}
?>