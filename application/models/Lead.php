<?php
class Lead extends CI_Model {

    private $idLead;
    private $idVisitante;
    private $pontuacao;
    private $enviado;

    public function __construct()
    {
        parent::__construct();
    }

    public function inserir()
    {
        $this->db->insert('lead', $this);
        $this->idLead = $this->db->insert_id();
    }

    public function setIdVisitante($idVisitante)
    {
        $this->idVisitante = trim($idVisitante);
    }

    public function setPontuacao($pontuacao)
    {
        $this->pontuacao = trim($pontuacao);
    }

    public function setEnviado($enviado)
    {
        $this->enviado = trim($enviado);
    }

}
