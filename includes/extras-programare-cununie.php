<?php

    $id_programare = $data['id'];
    $userid = $data['user_id'];
    $eveniment = $data['eveniment'];
    $data_si_ora = $data['data_si_ora'];

    $data_cateheza = $data_start_fara_ora = date("Y-m-d", strtotime($data["data_ora_cateheza"]));
    $ora_cateheza = date("H:i", strtotime($data["data_ora_cateheza"]));
    $data_simpla = date("d-m-Y", strtotime($data["data_si_ora"]));

    $nume_mire = $data['nume_mire'];
    $prenume_mire = $data['prenume_mire'];
    $nume_si_prenume_mire = $nume_mire . '-' . $prenume_mire;

    $nume_mireasa = $data['nume_mireasa'];
    $prenume_mireasa = $data['prenume_mireasa'];
    $nume_si_prenume_mireasa = $nume_mireasa . '-' . $prenume_mireasa;

    $adresa_mire =  $data['adresa_mire'];
    $adresa_mireasa =  $data['adresa_mireasa'];
    $telefon = $data['telefon'];
    $email = $data['email'];

    $numar_certificat_casatorie = $data['numar_certificat_casatorie'];
    $data_eliberarii_certificatului = $data['data_eliberarii_certificatului'];
    $eliberat_de_primaria = $data['eliberat_de_primaria'];
    $nume_nas = $data['nume_nas'];
    $nume_nasa = $data['nume_nasa'];
    $localitate_nasi = $data['localitate_nasi'];
    $nume_cameraman = $data['nume_cameraman'];
    $telefon_cameraman = $data['telefon_cameraman'];

    $link_mire_ci = $data['link_mire_ci'];
    $link_mireasa_ci = $data['link_mireasa_ci'];
    $link_plata_contributiei = $data['link_plata_contributiei'];
    $link_certificat_casatorie_civila = $data['link_certificat_casatorie_civila'];
    $link_certificat_botez_mire = $data['link_certificat_botez_mire'];
    $link_certificat_botez_mireasa = $data['link_certificat_botez_mireasa'];
    $link_dispensa = $data['link_dispensa'];
    $link_cerere = $data['link_cerere'];
    $data_ora_cateheza = $data['data_ora_cateheza'];
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
