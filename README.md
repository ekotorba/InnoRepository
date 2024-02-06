# Zadanie API NBP

Uruchomienie czystej instancji aplikacji z wybranym frameworkiem + commit z git init.

Wygenerowanie encji Currency z polami (wielkości pól w bazie proszę pobrać na podstawie własnych preferencji/doświadczeń):

id - uuid<br>
name - string - nazwa waluty<br>
currency_code - string -<br>
exchange_rate - proszę dobrać typ wg. własnych doświadczeń - wartość kursu waluty względem złotówki (czyli np. dla EURO będzie to np. 1 Euro = 4,75 PLN, czyli chcemy w bazie mieć wartość 4,75 lub np. 475 (w zależności od podejścia))<br>
Przygotowanie integracji z API NBP - http://api.nbp.pl/<br><br>
a) integracja powinna połączyć się z API NBP i pobrać dane o aktualnych kursach walut (z tabeli A)<br>
b) jeżeli dana waluta już istnieje, to powinna zostać zaktualizowana wartość exchange_rate<br>
c) jeżeli dana waluta nie istnieje, powinna zostać dodana<br>
