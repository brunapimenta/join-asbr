<?php
class Visitante extends CI_Model {

    private $idVisitante;
    private $nome;
    private $dataNascimento;
    private $email;
    private $telefone;
    private $regiao;
    private $unidade;
    private $token = '7c40a1ae1375fee874795382aa70b246';

    private $pontuacao = 10;
    private $hoje = '2016-11-01';
    private $regioes = array(
        'Sul' => 2,
        'Sudeste' => 1,
        'Centro-Oeste' => 3,
        'Nordeste' => 4,
        'Norte' => 5
    );

    public function __construct()
    {
        parent::__construct();
    }

    public function manter()
    {
        if ($this->idVisitante != '' || $this->existente()) {
            $this->alterar();
        } else {
            $this->inserir();
        }

        $this->calcular();
    }

    private function existente()
    {
        if ($this->email == '') {
            throw new Exception("Ocorreu um erro ao recuperar os dados", 400);
        }

        $this->db->select('*');
        $this->db->from('visitantes');
        $this->db->where('email', $this->email);

        if ($this->idVisitante != '') {
            $this->db->where('id_visitante !=', $this->idVisitante);
        }

        $consulta = $this->db->get();
        $visitante = $consulta->row();
        $existe = isset($visitante);

        if ($existe) {
            $this->idVisitante = $visitante->id_visitante;
        }

        return $existe;
    }

    private function inserir()
    {
        if ($this->nome == '' || $this->dataNascimento == '' || $this->email == '' ||
            $this->telefone == '' || $this->regiao == '' || $this->unidade == '') {
            throw new Exception("Ocorreu um erro ao salvar as informa&ccedil;&otilde;es", 400);
        }

        $this->db->set('nome', $this->nome);
        $this->db->set('data_nascimento', $this->dataNascimento);
        $this->db->set('email', $this->email);
        $this->db->set('telefone', $this->telefone);
        $this->db->set('regiao', $this->regiao);
        $this->db->set('unidade', $this->unidade);
        $this->db->set('token', $this->token);
        $this->db->insert('visitantes');
        $this->idVisitante = $this->db->insert_id();
    }

    private function alterar()
    {
        if ($this->idVisitante == '' || $this->nome == '' || $this->dataNascimento == '' || $this->email == '' ||
            $this->telefone == '' || $this->regiao == '' || $this->unidade == '') {
            throw new Exception("Ocorreu um erro ao salvar as informa&ccedil;&otilde;es", 400);
        }

        $this->db->set('nome', $this->nome);
        $this->db->set('data_nascimento', $this->dataNascimento);
        $this->db->set('email', $this->email);
        $this->db->set('telefone', $this->telefone);
        $this->db->set('regiao', $this->regiao);
        $this->db->set('unidade', $this->unidade);
        $this->db->set('token', $this->token);
        $this->db->where('id_visitante', $this->idVisitante);
        $this->db->update('visitantes');
    }

    private function calcular()
    {
        $this->calcularRegiao();
        $this->calcularIdade();
    }

    private function calcularRegiao()
    {
        if ($this->unidade !== 'São Paulo') {
            $this->pontuacao = $this->pontuacao - (int) $this->regioes[$this->regiao];
        }
    }

    private function calcularIdade()
    {
        $hoje = new DateTime($this->hoje);
        $nascimento = new DateTime($this->dataNascimento);
        $idade = $hoje->diff($nascimento);
        $idade = $idade->format('%y');

        if ($idade > 99 || $idade < 18) {
            $this->pontuacao -= 5;
        }

        if ($idade > 39 && $idade < 100) {
            $this->pontuacao -= 3;
        }
    }

    public function setNome($nome)
    {
        $this->nome = trim($nome);
    }

    public function setDataNascimento($dataNascimento)
    {
        $data = DateTime::createFromFormat('d/m/Y', trim($dataNascimento));
        $this->dataNascimento = trim($data->format('Y-m-d'));
    }

    public function setEmail($email)
    {
        $this->email = trim($email);
    }

    public function setTelefone($telefone)
    {
        $this->telefone = trim($telefone);
    }

    public function setRegiao($regiao)
    {
        $this->regiao = trim($regiao);
    }

    public function setUnidade($unidade)
    {
        $this->unidade = trim($unidade);
    }

    public function getIdVisitante()
    {
        return $this->idVisitante;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getTelefone()
    {
        return $this->telefone;
    }

    public function getRegiao()
    {
        return $this->regiao;
    }

    public function getUnidade()
    {
        return $this->unidade;
    }


    public function getDataNascimento()
    {
        return $this->dataNascimento;
    }

    public function getPontuacao()
    {
        return $this->pontuacao;
    }

    public function getToken()
    {
        return $this->token;
    }
}
