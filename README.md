Web Aplikacija koja pru�a uslugu skracivanja URL-a
Da bi aplikacija funkcionisala na va�em web serveru, potrebno je:
-	Napraviti bazu podataka sa imenom �urlshortener� na va�em serveru i dodeliti joj korisnika �root� bez sifre. I importovati koristeci file: �urlshortener.sql� koji se nalazi u folderu. Ili mo�ete importovati �urlshortener.sql� u neku drugu bazu, ali je onda potrebno adaptirati podatke u funkciji �connectToDatabase� koja se nalazi u datoteci functions.php kao prva.
-	Dodati Rewrite Rules koji se nalaze u .htaccess fajlu koji se nalazi u folderu Va�em .htaccess fajlu, ili da bi izbegli ne�eljene kolizije, mo�ete privremeno sacuvati Va� .htaccess i prekopirati ovaj prosledjeni kako biste testirali aplikaciju valjano.
-	Citav Folder �backend_tests� prekopirati u root va�eg servera.
-	Web servise mo�ete testirati onako kako ste Vi definisali u va�em zadatku, ali ...
-	Radi lak�eg upravljanja, napravio sam i jednostavan i skroman interface za kori�njenje ove web aplikacije, koji mo�ete videti otvarajuci http://localhost/url_shortener i na njemu cete moci da testirate Rad web aplikacije. 
-	Aplikacija uzima zadati url, od njega pravi hesh du�ine 8 karaktera, proverava da li dolazi do kolizije koju izbegavamo jeftinim dodavanjem nasumicnog jednocifrenog broja na hesh sve dok se ponavalja kolizija i kada je u redu pamti se poslednji kratki url.
-	Zahtevom serveru sa posaltim kratim url-om dobijamo redirekciju na pravi url koji se nalazi u bazi.
-	Ukoliko imate bilo kakva pitanja, molim Vas da ih postavite, bice mi drago da odgovorim na njih.
Bojan Milic
