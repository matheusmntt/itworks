<?php 

namespace Itworks\src\model;

use Itworks\core\Model;

// Classe responsável por gerenciar a conexão com a tabela conta

class ContaModel
{
    private $pdo; // Instância da classe model

    /**
    * Método construtor
    *
    * @return void 
    */  
    public function __construct()
    {
        $this->pdo = new Model();
    }

    public function insert(object $params)
    {
        $sql = "INSERT INTO 
                extrato 
                    (valor, movimentacao, dataRegistro)
                VALUES 
                    (:valor, :movimentacao, :dataRegistro)";

        $sqlParams = [
            ':valor'        => $params->valor,
            ':movimentacao' => $params->movimentacao,
            ':dataRegistro' => date('Y-m-d H:i:s')
        ];

        $handle = $this->pdo->executeNonQuery($sql, $sqlParams);

        if( !$handle )
        {
            return -1; // Código de erro
        }
        else 
        {
            return $this->pdo->GetLastId();
        }
    }

    /**
     * Retorna todos os registros da base de dados em ordem ascendente por dataRegistro
     * @return array[objetc]
     */
    public function getAll()
    {
        //Escrevemos a consulta SQL e atribuimos a variável $sql
        $sql = 'SELECT * FROM extrato ORDER BY dataRegistro ASC';

        // Executamos a consulta chamando o método da modelo
        //Atribuimos o resultado à variável $dt
        $dt = $this->pdo->executeQuery($sql);

        //Declara uma lista inicialmente nula
        $listaExtrato = null;

        //Percorremos todas as linhas do resultado da busca
        foreach($dt as $dr){
            //Atribuimos a última posição do array o produto devidamente tratado
            $listaExtrato[] = $this->collection($dr);
        }

        //Retornamos a lista de produtos
        return $listaExtrato;
    }

    /**
     * Converte uma estrutura de array vinda da base de dados em um objeto devidamente tratado
     * 
     * @param array|object $param Recebe o parâmetro que é retornado na consulta com a base de dados
     * 
     * @return object Retorna um objeto devidamente tratado com a estrutura de conta
     */

    private function collection($param)
    {
        //Operador Null Coalesce
        return (object)[
            'valor'         => $param['valor']          ?? null,
            'movimentacao'  => $param['movimentacao']   ?? null,
            'dataRegistro'  => date('Y-m-d H:i:s'),
        ];
    }
}   