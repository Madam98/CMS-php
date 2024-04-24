# CMS - blogit

Blog został przygotowany w trzech wersjach: virtualbox, docker oraz bezpośrednio kod. Konkretne wersje różnią się lekko między sobą aby umożliwić szybkie uruchomienie wszystkich wersji (głównie zmiana lokalizacji plików do których kod się odwołuje, inne adresy bazy danych oraz wyłączone buforowaniem danych wyjściowych dla wersji dockerowej, z powodów z występującym rutingiem i wymaganiem ponownego przesłania formularza)

W każdej wersji warto zwrócić na kilka rzeczy:
- każda wersja dla strony blogit posiada napisany skrypt uzupełnienia bazy danych przykładowymi danymi znajdującymi się w pliku db.create.php. Aby uzupełnić bazę danymi należy w pliku settings.php ustawić  CREATE_TABLE na wartość TRUE (w wersji dockerowej opis flagi znajduje się w docker-compose która należy ustawić na wartość TRUE). Następnie należy odświeżyć stronę aby uzupełnić bazę przykładowymi danymi.
- mogą wystąpić w przypadku ręcznej konfiguracji mogą wystąpić problemy z brakującymi plikami albo błąd intrernal error. W wyniku zmiany domeny należy zwrócić uwagę czy wszystkie pliki wskazują na tą samą domenę, a w przypadku zmiany lokalizacji pliku, zwrócić uwagę czy konfiguracja ROOT_PATH w dev.php wskazuje na lokalizację pliku. 
- panel składa się z dwóch stron: admin oraz blogit, które zostały skonfigurowane aby były odczytywane z localhost/admin oraz localhost/blogit
- domyślny login admina to adammi a hasło wszystkich kont to Password12345
- aby uniknąć błędów z uwierzytelnianiem na dwóch stronach zalecane jest uruchamianie dwóch stron w sesjach incognito albo uruchomić kod na dwóch domenach
- w zależności od wersji sposób do logowania może się lekko różnić jako login między "root" a "user".


# CMS - blogit - docker version
Struktura projektu składa się z dwóch kontenerów współpracujących ze sobą w ramach jednej sieci działających w trybie bridge. Pierwszy image adminblogit jest budowany lokalnie, drugi image mysql jest juz bezposrednio pobierany z internetu. Aby uruchomić oba kontenery należy w lokalizacji docker-compose wpisać tylko:

    docker compose up --build

Strony powinny być dostępne na localhost/admin oraz localhost/blogit. Oczywiście opis kodów znajduje się w odpowiednich folderach.

# CMS - blogit - kod
Aby móc uruchomić wersję w postaci kodu zalecane jest zainstalowanie xampp oraz skopiowanie danych folderów do lokalizacji xampp/htdocs. Następnie potrzebne jest ustawienie odpowiednich ścieżek ROOT_PATH.

# CMS - blogit - virtualbox
W folderze znajduje się link aby pobrać przygotowaną wersję virtualbox na dystrybucji kali linux (login kali hasło kali). Xampp z gotową bazą powinien być uruchomiony automatycznie. Lokalizacja plików serwera to /opt/lampp/htdocs. Baza danych dostepna pod localhost/phpmyadmin.
