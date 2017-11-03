<?php

namespace Seed;
use PDO;
defined('ENV') or die('O acesso direto ao script não é permitido!');

class Database 
{
    private $config;
    
    public function __construct() {
        $nucleos = new Nucleos;
        $this->config = $nucleos->getConfig();
    }

    private $conexao;

    protected function conn()
    {
        if (!isset($this->conexao))
        {      
            $this->conexao = new PDO('' . $this->config['database'][ENV]['driver'] . ':host=' . $this->config['database'][ENV]['host'] . '; dbname=' . $this->config['database'][ENV]['base'] . '', $this->config['database'][ENV]['user'], $this->config['database'][ENV]['pass'], array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
            $this->conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->conexao->setAttribute(PDO::ATTR_ORACLE_NULLS, PDO::NULL_EMPTY_STRING);
        }

        return $this->conexao;
    }

    //listar apenas colunas #select COLUMN_NAME from information_schema.COLUMNS where TABLE_NAME= 'oficio'
    //show CREATE TABLE usuario

    /**
     * @return true retorna ultimo ID inserido ou retorna false;
     * @example $valores = ['coluna'=>'valor','coluna2'=>'valor2'] <br> $this->insert('tabela',$valores);
     */
    protected function insert($tabela, $dados = [])
    {
        try
        {

            $atributos = implode(',', array_keys($dados));
            $valores   = ":" . implode(',:', array_keys($dados));

            $sql = "INSERT INTO $tabela($atributos) VALUES ($valores)";
            
            $consulta = $this->conn()->prepare($sql);

            foreach ($dados as $key => $value)
            {
                $consulta->bindValue(':' . $key, $value);
            }

            $teste = $consulta->execute();
            
            $id = $this->conn()->lastInsertId();
            return $id;
        }
        catch (Exception $e)
        {
            GeraLog::getInstance()->inserirLog($e->getCode(),$tabela,'Insert',$sql, $e->getMessage());
        }
    }

    /**
     * @return true retorna fetch,fetchall,rowcount;
     * @param $tabela string nome da tabela para consulta
     * @param $coluna string nome da coluna para condicao
     * @param $id string valor a procurar 
     * @param $fields colunas especificas para serem exibidas
     * @param $fetch default "1" // 0 = fetch , 1= fetchall, 2 = rowcount.
     * @example $this->select('tabela','coluna','valor','nome,id,endereco',0);
     */
    protected function select($tabela, $coluna = null, $id = null, $fields = null, $fetch = 1)
    {
        try
        {

            $itens    = isset($fields) ? $fields : "*";
            $condicao = isset($id) ? "WHERE $coluna = :id" : null;

            $sql = "SELECT $itens FROM $tabela $condicao";

            $consulta = $this->conn()->prepare($sql);

            if (isset($condicao))
            {

                $consulta->bindValue(':id', $id);
            }

            $consulta->execute();

            switch ($fetch)
            {
                case 0:
                    return $consulta->fetch(PDO::FETCH_ASSOC);
                    break;

                case 1:
                    return $consulta->fetchall(PDO::FETCH_ASSOC);
                    break;

                case 2:
                    return $consulta->rowcount(PDO::FETCH_ASSOC);
                    break;
                 case 3:
                    return $consulta->fetchall(PDO::FETCH_NUM);

                    break;
            }
        }
        catch (Exception $e)
        {
            GeraLog::getInstance()->inserirLog($e->getCode(),$tabela,'Select',$sql, $e->getMessage());
        }
    }

    /**
     * @return true retorna true ou retorna false;
     * @example $resultado = $this->delete('tabela','coluna','valor');
     */
    protected function delete($tabela, $coluna, $id)
    {
        try
        {

            $sql      = "DELETE FROM $tabela WHERE $coluna = :id";
            $consulta = $this->conn()->prepare($sql);
            $consulta->bindValue(':id', $id);

            $antes = $this->select($tabela, $coluna, $id, null, 0);

            $resultado = $consulta->execute();

            $this->auditoria($antes, $tabela, $coluna, $id, 'delete');

            return $resultado;
        }
        catch (Exception $e)
        {
            GeraLog::getInstance()->inserirLog($e->getCode(),$tabela,'Delete',$sql, $e->getMessage());
        }
    }

    /**
     * @example registrar alteracao pelo update e delete;
     */
    private function auditoria($antes, $tabela, $condicao, $igual, $acao)
    {
        $depois = $this->select($tabela, $condicao, $igual, null, 0);

        if ($acao == 'delete')
        {
            $dados_antes = serialize($antes);
        }
        else
        {
            $dados_antes = serialize(array_diff_assoc($antes, $depois));
        }

        $dados = [
            'log_aud_acesso'       => $_GET['url'],
            'log_aud_acao'         => $acao,
            'log_aud_dados_antes'  => $dados_antes,
            'log_aud_dados_depois' => serialize(array_diff_assoc($depois, $antes)),
            'usu_id'               => Session::get('usu_id'),
            'log_aud_permissao'    => serialize($this->session()->get('usu_permissao')),
            'log_aud_data'         => $this->data('atual', 'us', 'dh'),
            'log_aud_tabela'       => $tabela];

        $this->insert('log_auditoria', $dados);
    }

    /**
     * @return true retorna true ou retorna false;
     * @example $valores = ['coluna'=>'valor','coluna2'=>'valor2'] <br> $this->update($tabela,$condicao,$igual,$valores);
     */
    protected function update($tabela, $condicao, $igual, $dados = array())
    {
        try
        {
            foreach ($dados as $k => $v)
            {
                $array.= $k . " = :" . $k . ", ";
            }

            $retorno  = substr($array, 0, -2);
            $sql      = "UPDATE $tabela SET $retorno WHERE $condicao='$igual'";
            $consulta = $this->conn()->prepare($sql);

            foreach ($dados as $key => $value)
            {
                $consulta->bindValue(':' . $key, $value);
            }

            $antes = $this->select($tabela, $condicao, $igual, null, 0);

            $resultado = $consulta->execute();

            $this->auditoria($antes, $tabela, $condicao, $igual, 'update');

            return $resultado;
        }
        catch (Exception $e)
        {
            GeraLog::getInstance()->inserirLog($e->getCode(),$tabela,'Update',$sql, $e->getMessage());
        }
    }

    /**
     * @return true retorna ultimo ID inserido ;
     * @example $id = $this->ultimoId('cep_sergipe');
     */
    protected function lastId($tabela)
    {
        try
        {
            $banco = DB_BANCO;

            $sql       = "SELECT AUTO_INCREMENT FROM information_schema.tables WHERE table_name = '$tabela' AND table_schema = '$banco'";
            $consulta  = $this->conn()->prepare($sql);
            $consulta->execute();
            $resultado = $consulta->fetch(PDO::FETCH_ASSOC);

            return $resultado['AUTO_INCREMENT'];
        }
        catch (Exception $e)
        {
            GeraLog::getInstance()->inserirLog($e->getCode(),$tabela,'last_id',$sql, $e->getMessage());
        }
    }

}
