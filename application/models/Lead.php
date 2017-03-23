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
        $this->db->set('id_visitante', $this->idVisitante);
        $this->db->set('pontuacao', $this->pontuacao);
        $this->db->set('enviado', $this->enviado);
        $this->db->insert('leads');
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

    public function getIdLead()
    {
        return $this->idLead;
    }

}
