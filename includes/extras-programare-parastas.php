<?php
 
    $id = $data['id'];
    $userid = $data['user_id'];
    $eveniment = $data['eveniment'];
    $data_si_ora = $data['data_si_ora'];
    $nume = $data['nume'];
    $prenume = $data['prenume'];
    $telefon = $data['telefon'];
    $email = $data['email'];
    $adresa = $data['adresa'];
    $mesaj = $data['mesaj'];
    $status = $data['status'];

    switch ($status) {

        case '': 
          $clasa_accept = 'bg-primary'; 
          $status_accept_afisat = "Programare în curs de evaluare";
          $color = '#0d6efd';
        break;
      
        case 'acceptata': 
          $clasa_accept = 'bg-success'; 
          $status_accept_afisat = "Programare acceptată"; 
          $color = '#198754';
        break;
      
        case 'detalii': 
          $clasa_accept = 'bg-warning';
          $status_accept_afisat = "Cererea necesită detalii suplimentare"; 
          $color = '#ffc107';
        break;
      
        case 'respinsa': 
          $clasa_accept = 'bg-danger';
          $status_accept_afisat = "Programare respinsă"; 
          $color = '#dc3545';
        break;
        
      }

