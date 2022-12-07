<?php

include_once "conectar.php";

function selectHorarios(){
    $conectar = conectar("servidorouro", "bd_presencas", "prepara2", "prepara");
    $sql = "SELECT * FROM horarios ORDER BY Codigo";
    $query = $conectar->query($sql);
    return $query->fetchAll();
}

function selectDiasSemana(){
    $conectar = conectar("servidorouro", "bd_presencas", "prepara2", "prepara");
    $sql = "SELECT * FROM diassemana ORDER by Codigo";
    $query = $conectar->query($sql);
    return $query->fetchAll();
}

function selectGrade(){
    $conectar = conectar("servidorouro", "bd_presencas", "prepara2", "prepara");
    $sql = "SELECT H.Horario, 
    SUM(CASE WHEN CodigoDiaSemana = 2 THEN QtdAlunos ELSE 0 END) AS 'Segunda-feira', 
    SUM(CASE WHEN CodigoDiaSemana = 3 THEN QtdAlunos ELSE 0 END) AS 'Terça-feira',
    SUM(CASE WHEN CodigoDiaSemana = 4 THEN QtdAlunos ELSE 0 END) AS 'Quarta-feira',
    SUM(CASE WHEN CodigoDiaSemana = 5 THEN QtdAlunos ELSE 0 END) AS 'Quinta-feira',
    SUM(CASE WHEN CodigoDiaSemana = 6 THEN QtdAlunos ELSE 0 END) AS 'Sexta-feira',
    SUM(CASE WHEN CodigoDiaSemana = 7 THEN QtdAlunos ELSE 0 END) AS 'Sábado'
    
    FROM grade as G, diassemana AS D, horarios AS H WHERE G.CodigoDiaSemana = D.Codigo AND H.CodigoHorario = G.CodigoHorario GROUP BY H.Horario ORDER BY H.Horario";
    $query = $conectar->query($sql);
    return $query->fetchAll();
}