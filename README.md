# ci-core #

Pre release

Customização do core do Codeigniter 3.x para padroniação no Sesc em Minas

## Instalação ## 

Utilizando o composer,  adicione o repositório privado do sescmg no seu composer.json:

```json
{
  "repositories": [{
    "type": "composer",
    "url": "url-repositorio-sesc-mg"
  }]
}
```
E depois execute o comando:

```bash
composer install sescmg/ci-core
```


## CI output ##

Criada para padronizar as respostas json

### Como usar ###

Criar um arquivo **MY_Output** na pasta application\core, extendo o CiOutput, es funções estarção disponíveis através do *$this->output* nos controllers

```php
<?php

use Sescmg\CiCore\CiOutput;

class MY_Output extends CiOutput
{

}
```

### Funções disponíveis ###

- $this->output->jsonOk();
- $this->output->jsonCreated();
- $this->output->jsonBadRequest();
- $this->output->jsonUnauthorized();
- $this->output->jsonForbidden();
- $this->output->jsonNotFound();
- $this->output->jsonFormValidationError();

