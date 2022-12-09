             <?php
             
            
            $calendarMobil=[];
            $zi_aparte=[];
            $dezlegari=[];
            data_pastelui($year);
            $Pasti = $data_pastelui;
    
//---------------------------------------------------

            // Calculez dumincile dinainte și după Naștere în ANUL ANTERIOR

            $Nasterea_Domnului_0 = $year-1 . "-12-25";
            $ziua_sapt_Nasterea_Domnului_0 = (int)date('w', strtotime($Nasterea_Domnului_0));

            // dacă Nașterea Domnului cade duminica, adică este = 0

            If ($ziua_sapt_Nasterea_Domnului_0 == 0) {
                
                $Duminica_dinaintea_Nasterii_Domnului_0 = date('d M Y', strtotime($Nasterea_Domnului_0. ' -7 days'));
                $Nasterea_Domnului_0 = date("d M Y", strtotime($Nasterea_Domnului_0));
                $Duminica_dupa_Nasterea_Domnului_0 = $Nasterea_Domnului_0;

            } 
            
            //  dacă Nașterea Domnului cade în timpul săptămânii, adică este 1,2,3,4,5 si 6

            else {
                
                $Duminica_dinaintea_Nasterii_Domnului_0 = date('d M Y', strtotime($Nasterea_Domnului_0. '-' . $ziua_sapt_Nasterea_Domnului_0 . ' days'));
               
                $Nasterea_Domnului_0 = date("d M Y", strtotime($Nasterea_Domnului_0));

                $Duminica_dupa_Nasterea_Domnului_0 = date('d M Y', strtotime($Nasterea_Domnului_0. '+' . 7- $ziua_sapt_Nasterea_Domnului_0 . ' days'));

                $Miercuri_dupa_Nasterea_Domnului = date('d M Y', strtotime($Nasterea_Domnului_0. '+' . 3- $ziua_sapt_Nasterea_Domnului_0 . ' days'));
                $Vineri_dupa_Nasterea_Domnului = date('d M Y', strtotime($Nasterea_Domnului_0. '+' . 5- $ziua_sapt_Nasterea_Domnului_0 . ' days'));
                
            }
         
//---------------------------------------------------

            // Calculez data Duminicii Înainte de Botezul Domnului. 
            
            // Dacă Botezul Domnului cade duminica, adică este = 0

            $Botezul_Domnului = $year . "-01-06";
            $ziua_sapt_Botezul_Domnului = (int)date('w', strtotime($Botezul_Domnului));
            $Botezul_Domnului = date("d M Y", strtotime($Botezul_Domnului));
            
            If ($ziua_sapt_Botezul_Domnului == 0) {
                
                $Duminica_dinaintea_Botezului_Domnului = date('d M Y', strtotime($Botezul_Domnului. ' -7 days'));
                $Duminica_dupa_Botezul_Domnului = date('d M Y', strtotime($Botezul_Domnului. '+' . 7- $ziua_sapt_Botezul_Domnului . ' days'));

                // Duminica după Nașterea Domnului SĂ NU coincidă cu duminica dinaintea Botezului Domnului  
                if ($Duminica_dupa_Nasterea_Domnului_0 != $Duminica_dinaintea_Botezului_Domnului) {
                    $calendarMobil += [$Duminica_dinaintea_Botezului_Domnului => "Duminica_dinaintea_Botezului_Domnului"];
                }
                $calendarMobil += [$Duminica_dupa_Botezul_Domnului => "Duminica dupa Botezul Domnului"];

            } 

            //  dacă Botezul Domnului cade în timpul săptămânii

            elseIf ($ziua_sapt_Botezul_Domnului !== 0 ) {
                
                $Duminica_dinaintea_Botezului_Domnului = date('d M Y', strtotime($Botezul_Domnului. '-' . $ziua_sapt_Botezul_Domnului . ' days'));
               
                $Botezul_Domnului = date("d M Y", strtotime($Botezul_Domnului));

                $Duminica_dupa_Botezul_Domnului = date('d M Y', strtotime($Botezul_Domnului. '+' . 7- $ziua_sapt_Botezul_Domnului . ' days'));

                if ($Duminica_dupa_Nasterea_Domnului_0 != $Duminica_dinaintea_Botezului_Domnului) {
                    $calendarMobil += [$Duminica_dinaintea_Botezului_Domnului => "Duminica dinaintea Botezului Domnului"];
                }
                $calendarMobil += [$Duminica_dupa_Botezul_Domnului => "Duminica dupa Botezului Domnului"];
                
            } 

            // Numărul de săptămâni între Duminica după Botezul Domnului și Duminica a 33-a după Rusalii

            $Duminica_Rusalii_33 = date('d M Y', strtotime($Pasti. ' - 70 days'));

            $interval = date_diff(date_create ($Duminica_dupa_Botezul_Domnului), date_create ($Duminica_Rusalii_33));
            $nrZilePanaLaTriod = $interval->format('%R%a');
            $nrZilePanaLaTriod = (int)trim ($nrZilePanaLaTriod, "+");
            $nrSaptPanaLaTriod = (int) $nrZilePanaLaTriod / 7 - 1;
            
            $duminici_ramase = [
                    "Duminica a 29-a după Rusalii (a celor 10 leproși)",
                    "Duminica a 31-a după Rusalii (Vindecarea orbului din Ierihon)",
                    "Duminica a 32-a după Rusalii (a lui Zaheu vameșul)",
                    "Duminica a 15-a după Rusalii (Porunca cea mare din Lege)",
                    "Duminica a 16-a după Rusalii (Pilda talanților)",
                    "Duminica a 17-a după Rusalii (a Canaanencei)",
            ];

            if ($nrSaptPanaLaTriod == 1) {
                $data_duminicii = date('d M Y', strtotime($Duminica_dupa_Botezul_Domnului. ' + 7 days'));
                $calendarMobil += [$data_duminicii => "Duminica a 32-a după Rusalii (a lui Zaheu vameșul)"];
            }
            
            if ($nrSaptPanaLaTriod == 2) {
                $data_duminicii = date('d M Y', strtotime($Duminica_dupa_Botezul_Domnului. ' + 7 days'));
                $calendarMobil += [$data_duminicii => "Duminica a 29-a după Rusalii (a celor 10 leproși)"];

                $data_duminicii = date('d M Y', strtotime($Duminica_dupa_Botezul_Domnului. ' + 14 days'));
                $calendarMobil += [$data_duminicii => "Duminica a 32-a după Rusalii (a lui Zaheu vameșul)"];
            }
            
            if ($nrSaptPanaLaTriod == 3) {
                $data_duminicii = date('d M Y', strtotime($Duminica_dupa_Botezul_Domnului. ' + 7 days'));
                $calendarMobil += [$data_duminicii => "Duminica a 29-a după Rusalii (a celor 10 leproși)"];

                $data_duminicii = date('d M Y', strtotime($Duminica_dupa_Botezul_Domnului. ' + 14 days'));
                $calendarMobil += [$data_duminicii => "Duminica a 32-a după Rusalii (a lui Zaheu vameșul)"];
           
                $data_duminicii = date('d M Y', strtotime($Duminica_dupa_Botezul_Domnului. ' + 21 days'));
                $calendarMobil += [$data_duminicii => "Duminica a 17-a după Rusalii (a Canaanencei)"];
            }
                
            
            if ($nrSaptPanaLaTriod == 4) {

                $data_duminicii = date('d M Y', strtotime($Duminica_dupa_Botezul_Domnului. ' + 7 days'));
                $calendarMobil += [$data_duminicii => "Duminica a 29-a după Rusalii (a celor 10 leproși)"];

                $data_duminicii = date('d M Y', strtotime($Duminica_dupa_Botezul_Domnului. ' + 14 days'));
                $calendarMobil += [$data_duminicii => "Duminica a 31-a după Rusalii (Vindecarea orbului din Ierihon)"];

                $data_duminicii = date('d M Y', strtotime($Duminica_dupa_Botezul_Domnului. ' + 21 days'));
                $calendarMobil += [$data_duminicii => "Duminica a 32-a după Rusalii (a lui Zaheu vameșul)"];
            
                $data_duminicii = date('d M Y', strtotime($Duminica_dupa_Botezul_Domnului. ' + 28 days'));
                $calendarMobil += [$data_duminicii => "Duminica a 17-a după Rusalii (a Canaanencei)"];
            }
            
            if ($nrSaptPanaLaTriod == 5) {

                $data_duminicii = date('d M Y', strtotime($Duminica_dupa_Botezul_Domnului. ' + 7 days'));
                $calendarMobil += [$data_duminicii => "Duminica a 29-a după Rusalii (a celor 10 leproși)"];

                $data_duminicii = date('d M Y', strtotime($Duminica_dupa_Botezul_Domnului. ' + 14 days'));
                $calendarMobil += [$data_duminicii => "Duminica a 31-a după Rusalii (Vindecarea orbului din Ierihon)"];

                $data_duminicii = date('d M Y', strtotime($Duminica_dupa_Botezul_Domnului. ' + 21 days'));
                $calendarMobil += [$data_duminicii => "Duminica a 32-a după Rusalii (a lui Zaheu vameșul)"];
            
                $data_duminicii = date('d M Y', strtotime($Duminica_dupa_Botezul_Domnului. ' + 28 days'));
                $calendarMobil += [$data_duminicii => "Duminica a 16-a după Rusalii (Pilda talanților)"];

                $data_duminicii = date('d M Y', strtotime($Duminica_dupa_Botezul_Domnului. ' + 35 days')); 
                $calendarMobil += [$data_duminicii => "Duminica a 17-a după Rusalii (a Canaanencei)"];
            }
            
            if ($nrSaptPanaLaTriod == 6) {
                
                $data_duminicii = date('d M Y', strtotime($Duminica_dupa_Botezul_Domnului. ' + 7 days'));
                $calendarMobil += [$data_duminicii => "Duminica a 29-a după Rusalii (a celor 10 leproși)"];

                $data_duminicii = date('d M Y', strtotime($Duminica_dupa_Botezul_Domnului. ' + 14 days'));
                $calendarMobil += [$data_duminicii => "Duminica a 31-a după Rusalii (Vindecarea orbului din Ierihon)"];

                $data_duminicii = date('d M Y', strtotime($Duminica_dupa_Botezul_Domnului. ' + 21 days'));
                $calendarMobil += [$data_duminicii => "Duminica a 32-a după Rusalii (a lui Zaheu vameșul)"];
            
                $data_duminicii = date('d M Y', strtotime($Duminica_dupa_Botezul_Domnului. ' + 28 days'));
                $calendarMobil += [$data_duminicii => "Duminica a 15-a după Rusalii (Porunca cea mare din Lege)"];
            
                $data_duminicii = date('d M Y', strtotime($Duminica_dupa_Botezul_Domnului. ' + 35 days'));
                $calendarMobil += [$data_duminicii => "Duminica a 16-a după Rusalii (Pilda talanților)"];

                $data_duminicii = date('d M Y', strtotime($Duminica_dupa_Botezul_Domnului. ' + 42 days')); 
                $calendarMobil += [$data_duminicii => "Duminica a 17-a după Rusalii (a Canaanencei)"];
            }
                
            
            // Duminicile Triodului
    
            $calendarMobil += [$Duminica_Rusalii_33 => "Duminica a 33-a după Rusalii (a Vameșului și a Fariselui). Începutul Triodului"];

                $miercuri_harti_fiul_risipitor = date('d M Y', strtotime($Duminica_Rusalii_33. ' + 3 days'));
                $dezlegari += [$miercuri_harti_fiul_risipitor => "(Harți)"];
            
                $vineri_harti_fiul_risipitor = date('d M Y', strtotime($Duminica_Rusalii_33. ' + 5 days'));
                $dezlegari += [$vineri_harti_fiul_risipitor => "(Harți)"];
    
            $Duminica_Rusalii_34 = date('d M Y', strtotime($Pasti. ' - 63 days'));
            $calendarMobil += [$Duminica_Rusalii_34 => "Duminica a 34-a după Rusalii (a Întoarcerii Fiului risipitor)"];
    
                $Mosii_de_iarna = date('d M Y', strtotime($Pasti. ' - 57 days'));
                $zi_aparte += [$Mosii_de_iarna => "Sâmbăta morților - Moșii de iarnă"];
    
            $Duminica_3_Triod = date('d M Y', strtotime($Pasti. ' - 56 days'));
            $calendarMobil += [$Duminica_3_Triod => "Duminica Înfricoșătoarei judecăți (a Lăsatului sec de carne)"];

                $Miercuri_dezlegare_lasat_sec = date('d M Y', strtotime($Pasti. ' - 53 days'));
                $zi_aparte += [$Miercuri_dezlegare_lasat_sec => "Zi aliturgică. Dezlegare la brânză, lapte, ouă și pește"];

                $Vineri_dezlegare_lasat_sec = date('d M Y', strtotime($Pasti. ' - 51 days'));
                $zi_aparte += [$Vineri_dezlegare_lasat_sec => "Zi aliturgică. Dezlegare la brânză, lapte, ouă și pește"];

                $Sambata_Sf_Cuviosi = date('d M Y', strtotime($Pasti. ' - 50 days'));
                $zi_aparte += [$Sambata_Sf_Cuviosi => "Sâmbăta Sfinților Cuvioși"];

            $Duminica_4_Triod = date('d M Y', strtotime($Pasti. ' - 49 days'));
            $calendarMobil += [$Duminica_4_Triod => "Duminica izgonirii lui Adam din Rai (a Lăsatului sec de brânză)"];

            // Duminicile Postului Mare
    
                $Inceputul_Postului_Mare = date('d M Y', strtotime($Pasti. ' - 48 days'));
                $zi_aparte += [$Inceputul_Postului_Mare => "Începutul Postului Sfintelor Paști. Zi aliturgică. Canonul cel Mare"];
        
                $Marti_sapt_1_Postul_Mare = date('d M Y', strtotime($Pasti. ' - 47 days'));
                $zi_aparte += [$Marti_sapt_1_Postul_Mare => "Canonul cel Mare. Zi aliturgică."];
    
                $Miercuri_sapt_1_Postul_Mare = date('d M Y', strtotime($Pasti. ' - 46 days'));
                $zi_aparte += [$Miercuri_sapt_1_Postul_Mare => "Canonul cel Mare. Zi aliturgică."];
        
                $Joi_sapt_1_Postul_Mare = date('d M Y', strtotime($Pasti. ' - 45 days'));
                $zi_aparte += [$Joi_sapt_1_Postul_Mare => "Canonul cel Mare. Zi aliturgică."];
        
                $Sambata_Sf_Teodor_Tiron = date('d M Y', strtotime($Pasti. ' - 43 days'));
                $zi_aparte += [$Sambata_Sf_Teodor_Tiron => "Sâmbăta Sf. Mare Mucenic Teodor Tiron. Pomenirea morților."];
    
            $Duminica_1_Postul_Mare = date('d M Y', strtotime($Pasti. ' - 42 days'));
            $calendarMobil += [$Duminica_1_Postul_Mare => "Duminica Întâi din Post (a Ortodoxiei)"];
    
                $Pomenirea_mortilor_2 = date('d M Y', strtotime($Pasti. ' - 36 days'));
                $zi_aparte += [$Pomenirea_mortilor_2 => "Pomenirea morților"];
    
            $Duminica_2_Postul_Mare = date('d M Y', strtotime($Pasti. ' - 35 days'));
            $calendarMobil += [$Duminica_2_Postul_Mare => "Duminica a 2-a din Post (a Sfântului Grigorie Palama)"];

                $Pomenirea_mortilor_3 = date('d M Y', strtotime($Pasti. ' - 29 days'));
                $zi_aparte += [$Pomenirea_mortilor_3 => "Pomenirea morților"];
    
            $Duminica_3_Postul_Mare = date('d M Y', strtotime($Pasti. ' - 28 days'));
            $calendarMobil += [$Duminica_3_Postul_Mare => "Duminica a 3-a din Post (a Sfintei Cruci)"];

                $Pomenirea_mortilor_4 = date('d M Y', strtotime($Pasti. ' - 22 days'));
                $zi_aparte += [$Pomenirea_mortilor_4 => "Pomenirea morților"];
    
            $Duminica_4_Postul_Mare = date('d M Y', strtotime($Pasti. ' - 21 days'));
            $calendarMobil += [$Duminica_4_Postul_Mare => "Duminica a 4-a din Post (a Sf. Ioan Scărarul)"];

                $Denia_Canonului_Mare = date('d M Y', strtotime($Pasti. ' - 18 days'));
                $zi_aparte += [$Denia_Canonului_Mare => "Denia Canonului Mare"];

                $Denia_Buneivestiri = date('d M Y', strtotime($Pasti. ' - 16 days'));
                $zi_aparte += [$Denia_Buneivestiri => "Denia Acatistului Bunei Vestiri"];
            
                $Pomenirea_mortilor_5 = date('d M Y', strtotime($Pasti. ' - 15 days'));
                $zi_aparte += [$Pomenirea_mortilor_5 => "Pomenirea morților"];
    
            $Duminica_5_Postul_Mare = date('d M Y', strtotime($Pasti. ' - 14 days'));
            $calendarMobil += [$Duminica_5_Postul_Mare => "Duminica a 5-a din Post (a Cuvioasei Maria Egipteanca)"];

                $Pomenirea_mortilor_6 = date('d M Y', strtotime($Pasti. ' - 8 days'));
                $zi_aparte += [$Pomenirea_mortilor_6 => "Sâmbăta lui Lazăr. Pomenirea morților"];
    
            $Duminica_6_Postul_Mare = date('d M Y', strtotime($Pasti. ' - 7 days'));
            $calendarMobil += [$Duminica_6_Postul_Mare => "Duminica a 6-a din Post (a Floriilor). Intrarea Domnului în Ierusalim. (Denie)"];
         

    
            // Săptămâna Mare

            $Lunea_mare = date('d M Y', strtotime($Pasti. ' - 6 days'));
            $calendarMobil += [$Lunea_mare => "Sfânta și Marea zi de Luni (Denie)"];
    
            $Martea_mare = date('d M Y', strtotime($Pasti. ' - 5 days'));
            $calendarMobil += [$Martea_mare => "Sfânta și Marea zi de Marti (Denie)"];
    
            $Miercurea_mare = date('d M Y', strtotime($Pasti. ' - 4 days'));
            $calendarMobil += [$Miercurea_mare => "Sfânta și Marea zi de Miercuri (Denie)"];
    
            $Joia_mare = date('d M Y', strtotime($Pasti. ' - 3 days'));
            $calendarMobil += [$Joia_mare => "Sfânta și Marea zi de Joi (Denia celor 12 Evanghelii)"];
    
            $Vinerea_mare = date('d M Y', strtotime($Pasti. ' - 2 days'));
            $calendarMobil += [$Vinerea_mare => "Sfânta și Marea zi de Vineri (Zi aliturgică. Denia Prohodului Domnului.)"];
    
            $Sambata_mare = date('d M Y', strtotime($Pasti. ' - 1 days'));
            $calendarMobil += [$Sambata_mare => "Sfânta și Marea zi de Sâmbăta"];

          
            // Duminicile Penticostarului
            
            $calendarMobil += [$Pasti => "Învierea Domnului (Sfintele Paști)"];
            
            $Ziua_2_Pasti = date('d M Y', strtotime($Pasti. ' + 1 days'));
            $calendarMobil += [$Ziua_2_Pasti => "Sfintele Paști"];
            
            $Ziua_3_Pasti = date('d M Y', strtotime($Pasti. ' + 2 days'));
            $calendarMobil += [$Ziua_3_Pasti => "Sfintele Paști"];
            
                $Miercuri_Pasti_Harti = date('d M Y', strtotime($Pasti. ' + 3 days'));
                $dezlegari += [$Miercuri_Pasti_Harti => "(Harți)"];
                        
            $Izvorul_tamaduirii = date('d M Y', strtotime($Pasti. ' + 5 days'));
            $calendarMobil += [$Izvorul_tamaduirii => "Izvorul Tămăduirii "];
            $dezlegari += [$Izvorul_tamaduirii => "(Harți)"];

            $Duminica_2_dupa_Pasti = date('d M Y', strtotime($Pasti. ' + 7 days'));
            $calendarMobil += [$Duminica_2_dupa_Pasti => "Duminica a 2-a după Paști (a Sf. Apostol Toma)"];

                $Miercuri_Dezlegare_3 = date('d M Y', strtotime($Pasti. ' + 10 days'));
                $dezlegari += [$Miercuri_Dezlegare_3 => "Dezlegare la pește"];

                $Vineri_Dezlegare_3 = date('d M Y', strtotime($Pasti. ' + 12 days'));
                $dezlegari += [$Vineri_Dezlegare_3 => "Dezlegare la pește"];
            
            $Duminica_3_dupa_Pasti = date('d M Y', strtotime($Pasti. ' + 14 days'));
            $calendarMobil += [$Duminica_3_dupa_Pasti => "Duminica a 3-a după Paști (a Mironosițelor)"];

                $Miercuri_Dezlegare_4 = date('d M Y', strtotime($Pasti. ' + 17 days'));
                $dezlegari += [$Miercuri_Dezlegare_4 => "Dezlegare la pește"];

                $Vineri_Dezlegare_4 = date('d M Y', strtotime($Pasti. ' + 19 days'));
                $dezlegari += [$Vineri_Dezlegare_4 => "Dezlegare la pește"];
                
            $Duminica_4_dupa_Pasti = date('d M Y', strtotime($Pasti. ' + 21 days'));
            $calendarMobil += [$Duminica_4_dupa_Pasti => "Duminica a 4-a după Paști (Vindecarea slăbănogului de la Vitezda)"];

                $Miercuri_Dezlegare_5 = date('d M Y', strtotime($Pasti. ' + 24 days'));
                $zi_aparte += [$Miercuri_Dezlegare_5 => "Înjumătățirea Cincizecimii."];
                $dezlegari += [$Miercuri_Dezlegare_5 => "Dezlegare la pește"];

                $Vineri_Dezlegare_5 = date('d M Y', strtotime($Pasti. ' + 26 days'));
                $dezlegari += [$Vineri_Dezlegare_5 => "Dezlegare la pește"];
            
            $Duminica_5_dupa_Pasti = date('d M Y', strtotime($Pasti. ' + 28 days'));
            $calendarMobil += [$Duminica_5_dupa_Pasti => "Duminica a 5-a după Paști (a Samarinencei)"];

                $Miercuri_Dezlegare_5 = date('d M Y', strtotime($Pasti. ' + 31 days'));
                $zi_aparte += [$Miercuri_Dezlegare_5 => "Odovania Înjumătățirii Cincizecimii. "];
                $dezlegari += [$Miercuri_Dezlegare_5 => "Dezlegare la pește"];

                $Vineri_Dezlegare_5 = date('d M Y', strtotime($Pasti. ' + 33 days'));
                $dezlegari += [$Vineri_Dezlegare_5 => "Dezlegare la pește"];
            
            $Duminica_6_dupa_Pasti = date('d M Y', strtotime($Pasti. ' + 35 days'));
            $calendarMobil += [$Duminica_6_dupa_Pasti => "Duminica a 6-a după Paști (Vindecarea orbului din naștere)"];

                $Miercuri_Dezlegare_6 = date('d M Y', strtotime($Pasti. ' + 38 days'));
                $zi_aparte += [$Miercuri_Dezlegare_6 => "Odovania Praznicului Învierii Domnului."];
                $dezlegari += [$Miercuri_Dezlegare_6 => "Dezlegare la pește"];
                
                $Inaltarea_Domnului = date('d M Y', strtotime($Pasti. ' + 39 days'));
                $calendarMobil += [$Inaltarea_Domnului => "Înălțarea Domnului (Ziua Eroilor)"];
                
                $Vineri_Dezlegare_6 = date('d M Y', strtotime($Pasti. ' + 40 days'));
                $dezlegari += [$Vineri_Dezlegare_6 => "Dezlegare la pește"];
            
            $Duminica_7_dupa_Pasti = date('d M Y', strtotime($Pasti. ' + 42 days'));
            $calendarMobil += [$Duminica_7_dupa_Pasti => "Duminica a 7-a după Paști (a Sf. Părinți de la Sinodul I Ecumenic)"];

                $Miercuri_Dezlegare_7 = date('d M Y', strtotime($Pasti. ' + 45 days'));
                $dezlegari += [$Miercuri_Dezlegare_7 => "Dezlegare la pește"];

                $Vineri_Dezlegare_7 = date('d M Y', strtotime($Pasti. ' + 47 days'));
                $zi_aparte += [$Vineri_Dezlegare_7 => "Odovania praznicului Înălțării Domnului."];
                $dezlegari += [$Vineri_Dezlegare_7 => "Dezlegare la pește"];

                $Mosii_de_vara = date('d M Y', strtotime($Pasti. ' + 48 days'));
                $zi_aparte += [$Mosii_de_vara => "Sâmbăta morților. Moșii de vară"];
            
            $Rusalii = $Duminica_Pogorarii_Duhului_Sfant = date('d M Y', strtotime($Pasti. ' + 49 days'));
            $calendarMobil += [$Duminica_Pogorarii_Duhului_Sfant => "Pogorârea Sfântului Duh (Cincizecimea sau Rusaliile). Duminica a 8-a după Paști."];
            
            $Sfanta_Treime = date('d M Y', strtotime($Pasti. ' + 50 days'));
            $calendarMobil += [$Sfanta_Treime => "Sfânta Treime"];

                $Miercuri_Cincizecime = date('d M Y', strtotime($Rusalii. ' + 3 days'));
                $dezlegari += [$Miercuri_Cincizecime => "(Harți)"];

                $Vineri_Cincizecime = date('d M Y', strtotime($Rusalii. ' + 5 days'));
                $dezlegari += [$Vineri_Cincizecime => "(Harți)"];

                $Sambata_Dupa_Cincizecime = date('d M Y', strtotime($Rusalii. ' + 6 days'));
                $zi_aparte += [$Sambata_Dupa_Cincizecime => "Odavania praznicului Pogorârii Sfântului Duh"];

            // Octoihul

            $Duminica_Rusalii_1 = $Duminica_Tuturor_Sfintilor = date('d M Y', strtotime($Rusalii. ' + 7 days'));
            $calendarMobil += [$Duminica_Tuturor_Sfintilor => "Duminica întâi după Rusalii (a Tuturor Sfinților)"];
            
            // // Postul Sfinților Apostoli Petru și Pavel
            
            // $data_sf_apostoli = $year . "-06-29";
            
            // $Postul_Sf_Apostoli = date_diff(date_create ($Duminica_Tuturor_Sfintilor), date_create ($data_sf_apostoli));
            // $nrZileRamaseSfAp = (int)$Postul_Sf_Apostoli->format('%R%a');
            
            // if ($nrZileRamaseSfAp > 7) {
            //     $Inceputul_Postului_Sf_Apostoli = date('d M Y', strtotime($Duminica_Tuturor_Sfintilor. ' + 1 days'));
            //     $calendarMobil += [ $Inceputul_Postului_Sf_Apostoli => "Începutul Postului Sf. Ap. Petru și Pavel"];
            // }

            // if ($nrZileRamaseSfAp < 7 && $nrZileRamaseSfAp > 2) {
            //     $Inceputul_Postului_Sf_Apostoli = date('d M Y', strtotime($Duminica_Tuturor_Sfintilor. ' + 2 days'));
            //     $calendarMobil += [ $Inceputul_Postului_Sf_Apostoli => "Începutul Postului Sf. Ap. Petru și Pavel"];
            //     }
                
            //     if ($nrZileRamaseSfAp < 0 ) {
            //         $Inceputul_Postului_Sf_Apostoli = date('d M Y', strtotime($data_sf_apostoli. ' - 7 days'));
            //         $calendarMobil += [ $Inceputul_Postului_Sf_Apostoli => "Începutul Postului Sf. Ap. Petru și Pavel"];
            //     }
                
            $Duminica_Rusalii_2 = date('d M Y', strtotime($Rusalii. ' + 14 days'));
            $calendarMobil += [$Duminica_Rusalii_2 => "Duminica a 2-a după Rusalii (a Sfinților Români)"];
            
            $Duminica_Rusalii_3 = date('d M Y', strtotime($Rusalii. ' + 21 days'));
            $calendarMobil += [$Duminica_Rusalii_3 => "Duminica a 3-a după Rusalii (Despre grijile vieții)"];
            
            $Duminica_Rusalii_4 = date('d M Y', strtotime($Rusalii. ' + 28 days'));
            $calendarMobil += [$Duminica_Rusalii_4 => "Duminica a 4-a după Rusalii (Vindecarea slujii sutașului)"];
            
            $Duminica_Rusalii_5 = date('d M Y', strtotime($Rusalii. ' + 35 days'));
            $calendarMobil += [$Duminica_Rusalii_5 => "Duminica a 5-a după Rusalii (a Sf. Părinți de la Sinodul al IV-lea Ecumenic. Vindecarea celor doi demonizați din ținutul Gadarei.)"];
            
            $Duminica_Rusalii_6 = date('d M Y', strtotime($Rusalii. ' + 42 days'));
            $calendarMobil += [$Duminica_Rusalii_6 => "Duminica a 6-a după Rusalii (Vindecarea slăbănogului din Capernaum)"];
            
            $Duminica_Rusalii_7 = date('d M Y', strtotime($Rusalii. ' + 49 days'));
            $calendarMobil += [$Duminica_Rusalii_7 => "Duminica a 7-a după Rusalii (Vindecarea a doi orbi și a unui mut din Capernaum)"];
            
            $Duminica_Rusalii_8 = date('d M Y', strtotime($Rusalii. ' + 56 days'));
            $calendarMobil += [$Duminica_Rusalii_8 => "Duminica a 8-a după Rusalii (Înmulțirea pâinilor)"];
            
            $Duminica_Rusalii_9 = date('d M Y', strtotime($Rusalii. ' + 63 days'));
            $calendarMobil += [$Duminica_Rusalii_9 => "Duminica a 9-a după Rusalii (Umblarea pe mare. Potolirea furtunii.)"];
            
            $Duminica_Rusalii_10 = date('d M Y', strtotime($Rusalii. ' + 70 days'));
            $calendarMobil += [$Duminica_Rusalii_10 => "Duminica a 10-a după Rusalii (Vindecarea lunaticului)"];

            // verific dacă Înălțarea Sfintei Cruci cade duminica, adică este = 0

            $Inaltarea_Sfintei_Cruci = $year . "-09-14";
            
            $ziua_sapt_Inaltarea_Sfintei_Cruci = (int)date('w', strtotime($Inaltarea_Sfintei_Cruci));

            If ($ziua_sapt_Inaltarea_Sfintei_Cruci == 0) {
                
                $Duminica_dinaintea_Inaltarii_Sf_Cruci = date('d M Y', strtotime($Inaltarea_Sfintei_Cruci. ' -7 days'));
                $Inaltarea_Sfintei_Cruci = date("d M Y", strtotime($Inaltarea_Sfintei_Cruci));
                $Duminica_dupa_Inaltarea_Sf_Cruci = date('d M Y', strtotime($Inaltarea_Sfintei_Cruci. ' +7 days'));
               
            } 
            
            // dacă Înălțarea Sfintei Cruci cade în timpul săptămânii

            else {
                
                $Duminica_dinaintea_Inaltarii_Sf_Cruci = date('d M Y', strtotime($Inaltarea_Sfintei_Cruci. '-' . $ziua_sapt_Inaltarea_Sfintei_Cruci . ' days'));
               
                $Inaltarea_Sfintei_Cruci = date("d M Y", strtotime($Inaltarea_Sfintei_Cruci));
           
                $Duminica_dupa_Inaltarea_Sf_Cruci = date('d M Y', strtotime($Inaltarea_Sfintei_Cruci. '+' . 7- $ziua_sapt_Inaltarea_Sfintei_Cruci . ' days'));
                
            }

            // condiție: Duminicile să nu fie mai târzii decât Duminica dinaintea Înălțării Sfintei Cruci

            $Duminica_Rusalii_11 = date('d M Y', strtotime($Rusalii. ' + 77 days'));
            if ( strtotime($Duminica_Rusalii_11) < strtotime($Duminica_dinaintea_Inaltarii_Sf_Cruci) ) {
                $calendarMobil += [$Duminica_Rusalii_11 => "Duminica a 11-a după Rusalii (Pilda datornicului nemilostiv)"];
            }
            
            $Duminica_Rusalii_12 = date('d M Y', strtotime($Rusalii. ' + 84 days'));
            if ( strtotime($Duminica_Rusalii_12) < strtotime($Duminica_dinaintea_Inaltarii_Sf_Cruci) ) {
                $calendarMobil += [$Duminica_Rusalii_12 => "Duminica a 12-a după Rusalii (Tânărul bogat)"];
            }
            
            $Duminica_Rusalii_13 = date('d M Y', strtotime($Rusalii. ' + 91 days'));
            if ( strtotime($Duminica_Rusalii_13) < strtotime($Duminica_dinaintea_Inaltarii_Sf_Cruci) ) {
                $calendarMobil += [$Duminica_Rusalii_13 => "Duminica a 13-a după Rusalii (Pilda lucrătorilor celor răi)"];
            }
            
            $Duminica_Rusalii_14 = date('d M Y', strtotime($Rusalii. ' + 98 days'));
            if ( strtotime($Duminica_Rusalii_14) < strtotime($Duminica_dinaintea_Inaltarii_Sf_Cruci) ) {
                $calendarMobil += [$Duminica_Rusalii_14 => "Duminica a 14-a după Rusalii (Pilda nunții fiului de împărat)"];
            }
            
            $Duminica_Rusalii_15 = date('d M Y', strtotime($Rusalii. ' + 105 days'));
            if ( strtotime($Duminica_Rusalii_15) < strtotime($Duminica_dinaintea_Inaltarii_Sf_Cruci) ) {
                $calendarMobil += [$Duminica_Rusalii_15 => "Duminica a 15-a după Rusalii (Porunca cea mare din Lege)"];
            }

            $calendarMobil += [$Duminica_dinaintea_Inaltarii_Sf_Cruci => "Duminica dinaintea Înălțării Sfintei Cruci"];

            $calendarMobil += [$Duminica_dupa_Inaltarea_Sf_Cruci => "Duminica după Înălțărea Sfintei Cruci"];

            $Duminica_Rusalii_18 = date('d M Y', strtotime( $Duminica_dupa_Inaltarea_Sf_Cruci. ' + 7 days'));
            $calendarMobil += [$Duminica_Rusalii_18 => "Duminica a 18-a după Rusalii (Pescuirea minunată)"];
            
            $Duminica_Rusalii_19 = date('d M Y', strtotime( $Duminica_dupa_Inaltarea_Sf_Cruci. ' + 14 days'));
            $calendarMobil += [$Duminica_Rusalii_19 => "Duminica a 19-a după Rusalii (Predica de pe munte - iubirea vrăjmașilor)"];
   
            // condiție: Duminica a 21-a după Rusalii să fie în intervalul 11-17 octombrie

            for ($x=11; $x <= 17; $x++) {

                $Duminica_Rusalii_21 = $year . "-10-" . $x;
                $ziua_Duminica_Rusalii_21 = (int)date('w', strtotime($Duminica_Rusalii_21));
            
                if ($ziua_Duminica_Rusalii_21 == 0) {
                    $Duminica_Rusalii_21_corecta = date('d M Y', strtotime($Duminica_Rusalii_21));

                    $calendarMobil += [$Duminica_Rusalii_21_corecta => "Duminica a 21-a după Rusalii (a Sf. Părinți de la Sinodul al VII-lea ecumenic)"];
                }
            }


            // condiție: Duminica a 22-a după Rusalii să fie în intervalul 30 oct. - 5 nov.

            // Pt 30 si 31 oct.
            for ($x=30; $x <= 31; $x++) {

                $Duminica_Rusalii_22 = $year . "-10-" . $x;
                $ziua_Duminica_Rusalii_22 = (int)date('w', strtotime($Duminica_Rusalii_22));
                
                if ($ziua_Duminica_Rusalii_22 == 0) {

                    $Duminica_Rusalii_22_corecta = date('d M Y', strtotime($Duminica_Rusalii_22));

                     $calendarMobil += [$Duminica_Rusalii_22_corecta => "Duminica a 22-a după Rusalii (Bogatul nemilostiv și săracul Lazăr)"];
                   
                }

            }

            // Pentru 1-5 nov.
            for ($x=1; $x <= 5; $x++) {

                $Duminica_Rusalii_22 = $year . "-11-" . $x;
                $ziua_Duminica_Rusalii_22 = (int)date('w', strtotime($Duminica_Rusalii_22));

                if ($ziua_Duminica_Rusalii_22 == 0) {

                    $Duminica_Rusalii_22_corecta = date('d M Y', strtotime($Duminica_Rusalii_22));

                     $calendarMobil += [$Duminica_Rusalii_22_corecta => "Duminica a 22-a după Rusalii (Bogatul nemilostiv și săracul Lazăr)"];
                }

            }


            // Aflu toate duminicile rămase libere în octombrie 

                $duminici_libere_oct_nov  = array();

                aflaDuminici ($year, 10);
                foreach ($duminici_in_luna as $dum) {
                    $duminica = date('d M Y', strtotime($dum . '-10-' . $year)); 
                    if ( !array_key_exists($duminica, $calendarMobil) ) {
                        $duminici_libere_oct_nov[] = $duminica;
                    }
                } 
           

            // Ultimele trei duminici din luna noiembrie sunt întotdeauna 
                // Duminica a 25-a (Pilda Samarineanului milostiv), 
                // Duminica a 26-a (Pilda bogatului căruia i-a rodit țarina) și 
                // Duminica a 30-a (Dregătorul bogat – păzirea poruncilor)

          
            // aflu sambatele din luna noiembrie
            aflaSambete($year, 11);
            $Mosii_de_toamna =  $year . '-11-' . reset($sambete_in_luna);
            $Mosii_de_toamna =  date('d M Y', strtotime ($Mosii_de_toamna));
            $zi_aparte += [$Mosii_de_toamna => "Sâmbăta morților - Moșii de toamnă."];

            // aflu duminicile din luna noiembrie
            aflaDuminici ($year, 11);
            end($duminici_in_luna);

            $ultima_duminica_din_nov = $year . '-11-' . end($duminici_in_luna);

            $Duminica_Rusalii_25 = date('d M Y', strtotime(  $ultima_duminica_din_nov. ' - 14 days'));
            $calendarMobil += [$Duminica_Rusalii_25 => "Duminica a 25-a după Rusalii (Pilda Samarineanului milostiv)"];
 
            $Duminica_Rusalii_26 = date('d M Y', strtotime(  $ultima_duminica_din_nov. ' - 7 days'));
            $calendarMobil += [$Duminica_Rusalii_26 => "Duminica a 26-a după Rusalii (Pilda bogatului căruia i-a rodit țarina)"];

                $Ultima_Sambata_Nov = date('d M Y', strtotime(  $ultima_duminica_din_nov. ' - 1 days'));
                $dezlegari += [$Ultima_Sambata_Nov => "Dezlegare la pește"];
 
            $Duminica_Rusalii_30 = date('d M Y', strtotime(  $ultima_duminica_din_nov));
            $calendarMobil += [$Duminica_Rusalii_30 => "Duminica a 30-a după Rusalii (Dregătorul bogat - păzirea poruncilor)"];
            $dezlegari += [$Duminica_Rusalii_30 => "Dezlegare la pește"];

            
            // Aflu toate duminicile rămase libere în noiembrie 
   
                foreach ($duminici_in_luna as $dum) {
                    $duminica = date('d M Y', strtotime($dum .  '-11-' . $year)); 
                    if ( !array_key_exists($duminica, $calendarMobil) ) {
                        $duminici_libere_oct_nov[]= $duminica;
                    }
                } 
           
            if (array_key_last($duminici_libere_oct_nov) == 2) {

                $Duminica_Rusalii_20 = date('d M Y', strtotime( $duminici_libere_oct_nov[0] ));
                $calendarMobil += [$Duminica_Rusalii_20 => "Duminica a 20-a după Rusalii (Învierea fiului văduvei din Nain)"];
                
                $Duminica_Rusalii_23 = date('d M Y', strtotime( $duminici_libere_oct_nov[1] ));
                $calendarMobil += [$Duminica_Rusalii_23 => "Duminica a 23-a după Rusalii (Vindecarea demonizatului din ținutul Gherghesenilor)"];

                $Duminica_Rusalii_24 = date('d M Y', strtotime( $duminici_libere_oct_nov[2] ));
                $calendarMobil += [$Duminica_Rusalii_24 => "Duminica a 24-a după Rusalii (Învierea fiicei lui Iair)"];
            }

            if (array_key_last($duminici_libere_oct_nov) == 1) {

                $Duminica_Rusalii_20 = date('d M Y', strtotime( $duminici_libere_oct_nov[0] ));
                $calendarMobil += [$Duminica_Rusalii_20 => "Duminica a 20-a după Rusalii (Învierea fiului văduvei din Nain)"];
                
                $Duminica_Rusalii_23 = date('d M Y', strtotime( $duminici_libere_oct_nov[1] ));
                $calendarMobil += [$Duminica_Rusalii_23 => "Duminica a 23-a după Rusalii (Vindecarea demonizatului din ținutul Gherghesenilor)"];

            }


            // Calculez data Duminicii Înainte de Nașterea Domnului. 
            // Verific dacă Nașterea Domnului cade duminica, adică este = 0

            $Nasterea_Domnului = $year . "-12-25";
            
            $ziua_sapt_Nasterea_Domnului = (int)date('w', strtotime($Nasterea_Domnului));


            // dacă Nașterea Domnului cade duminica

            If ($ziua_sapt_Nasterea_Domnului == 0) {
                
                $Duminica_dinaintea_Nasterii_Domnului = date('d M Y', strtotime($Nasterea_Domnului. ' -7 days'));
                $Nasterea_Domnului = date("d M Y", strtotime($Nasterea_Domnului));
                $Duminica_dupa_Nasterea_Domnului = NULL;

                $Miercuri_dupa_Nasterea_Domnului = date('d M Y', strtotime($Nasterea_Domnului. ' +3 days'));
                $Vineri_dupa_Nasterea_Domnului = date('d M Y', strtotime($Nasterea_Domnului. ' +5 days'));
            } 
            
            //  dacă Nașterea Domnului cade în timpul săptămânii

            else {
                
                $Duminica_dinaintea_Nasterii_Domnului = date('d M Y', strtotime($Nasterea_Domnului. '-' . $ziua_sapt_Nasterea_Domnului . ' days'));
               
                $Nasterea_Domnului = date("d M Y", strtotime($Nasterea_Domnului));

                $Duminica_dupa_Nasterea_Domnului = date('d M Y', strtotime($Nasterea_Domnului. '+' . 7- $ziua_sapt_Nasterea_Domnului . ' days'));
                
            }

            // Duminicile a 27-a (Tămăduirea femeii gârbove) și Duminica a 28-a (Pilda celor poftiți la cină) vor fi așezate totdeauna ca antepenultima, respectiv penultima înainte de Nașterea Domnului

            $Duminica_Rusalii_27 = date('d M Y', strtotime($Duminica_dinaintea_Nasterii_Domnului. ' - 14 days'));

            // Dacă luna decembrie are cinci duminici încape aici și Duminica a 31-a (condiție)

            $prima_zi_dec = $year . '-12-01';

            $interval = date_diff(date_create ($prima_zi_dec), date_create ($Duminica_Rusalii_27));
            $nrZile = $interval->format('%R%a');
            $nrZile = (int)trim ($nrZile, "+");

            if($nrZile > 6) {

                $Duminica_Rusalii_31 = date('d M Y', strtotime($Duminica_dinaintea_Nasterii_Domnului. ' - 21 days'));
                $calendarMobil += [$Duminica_Rusalii_31 => "Duminica a 31-a după Rusalii (Vindecarea orbului din Ierihon)"];

            }

                $Sambata_dinaintea_Duminicii_27 = date('d M Y', strtotime($Duminica_Rusalii_27. ' - 1 days'));
                $dezlegari += [$Sambata_dinaintea_Duminicii_27 => "Dezlegare la pește"];

            $calendarMobil += [$Duminica_Rusalii_27 => "Duminica a 27-a după Rusalii (Tămăduirea femeii gârbove)"];
            $dezlegari += [$Duminica_Rusalii_27 => "Dezlegare la pește"];

                $Sambata_dinaintea_Duminicii_27 = date('d M Y', strtotime($Duminica_Rusalii_27. ' +6 days'));
                $dezlegari += [$Sambata_dinaintea_Duminicii_27 => "Dezlegare la pește"];

            $Duminica_Rusalii_28 = date('d M Y', strtotime($Duminica_dinaintea_Nasterii_Domnului. ' - 7 days'));
            $calendarMobil += [$Duminica_Rusalii_28 => "Duminica a 28-a după Rusalii (a Sf. Strămoși după trup ai Domnului.)"];
            $calendarMobil += [$Duminica_Rusalii_28 => "Dezlegare la pește"];

            $calendarMobil += [$Duminica_dinaintea_Nasterii_Domnului => "Duminica dinaintea Nașterii Domnului"];
                
            $calendarMobil += [$Duminica_dupa_Nasterea_Domnului => "Duminica după Nașterea Domnului"];

            
            // sortez array-ul în ordinea cronologică a datelor

                foreach ($calendarMobil as $data => $numele_duminicii) {
                    $sort[$data] = strtotime($data);
                }

                array_multisort($sort, SORT_ASC, $calendarMobil);

          
                
            
                    ?>

                </div>    
        </div>

    </div>
          
</div>




<?php include "../includes/footer.php"?>
</body>
</html>


