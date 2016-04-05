# Readme #

Il plugin ha un'archiettura modulare.

Per sviluppare funzionalità è possibile usare come base il modulo `sample` in `wp-content/plugins/fashionis-shop/src/modules/sample`.

Bisogna duplicarlo e fare un replace di tutte le occorrenze di "sample" e "SampleModule" con il nome del nuovo modulo.

Infine bisogna aggiungerlo a: `wp-content/plugins/fashionis-shop/src/includes/Plugin.php` linee 36-40.

La struttura di un modulo è semplice:

- `SampleModule.php` contiene solo gli hook per le funzioni:
	- https://codex.wordpress.org/Plugin_API/Action_Reference
	- https://codex.wordpress.org/Plugin_API/Filter_Reference
	- https://docs.woothemes.com/document/hooks/

- `Admin.php` contiene le funzioni associate agli hook per l'area amministrazione e robe di backend.

- `Public.php` contiene le funzioni associate agli hook per robe di frontend.

- L'eventuale cartella `views` contiene le view associate al modulo.

Non bisogna preoccuparsi di fare `require` e `include` fintanto che si rispetta l'architettura PSR-4: http://www.php-fig.org/psr/psr-4/it/

L'autoloader PS4 è definito in: `wp-content/plugins/fashionis-shop/fashionis-shop.php`.

## VIEWS ##

E' possibile sviluppare le funzionalità della plugin con un'architettura MVC. Le view sono fornite dalla classe `\FisPressShop\includes\View`.

Esempi di utilizzo in:
 
`/wp-content/plugins/fashionis-shop/src/modules/taxonomies/admin/Admin.php` -> `display_color_hex_field_to_color().`

Presto approfondimenti.

- Riccardo D'Angelo