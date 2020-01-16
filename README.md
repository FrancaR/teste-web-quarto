# Sobre

Esse sistema foi desenvolvido com o intuito de concorrer a vaga de Full Stack Developer da [WebQuarto](https://www.webquarto.com.br).

# Configurações

Para o sistema funcionar corretamente, precisamos configurar algumas coisas.

No arquivo `.env`, preencheremos o parametro `GOOGLE_MAPS_API_KEY` com a nossa chave da API do Google Maps.

O sistema foi preparado com `seeders`, para facilitar a verificação do teste, mas, pode apresentar alguns problemas, veja a seção **Soluções de Problemas**.

# Soluções de Problemas

## O Google Maps não está carregando

Vá até a pasta `resources/js`, e no arquivo `app.js`, na linha 28, altere o parametro `process.env.GOOGLE_MAPS_API_KEY` pela sua chave da API do Google Maps. Após esse procedimento, execute o comando `npm run prod` ou `yarn run prod`.

## As imagens inseridas pelo Seeder não estão carregando

O processo de Seeder utiliza o [Faker](https://github.com/fzaninotto/Faker), que usa o [LoremPixel](http://lorempixel.com/) como provedor de imagens, mas o mesmo apresenta instabilidade constante, conforme reportado em várias `issues`. Sugiro que faça os cadsatros manualmente.