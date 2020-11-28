1. Генерация ключа УЦ: (да)
openssl genpkey -engine gost -algorithm gost2012_512 -pkeyopt paramset:A -out ca.key

2. Создание самоподписанного сертификата УЦ: (да)
openssl req -engine gost -x509 -newkey gost2012_512 -new -key ca.key -out ca.crt

3. Создание CSR и Ключа в OpenSSL Без Вопросов (да)
Используйте следующую команду для генерации нового 2048-битного секретного ключа example.key и создания CSR example.csr на его основании:
openssl req -nodes -newkey gost2012_512 -keyout client.key -pkeyopt paramset:A  -out client.csr -subj "/C=RU/ST=Udmurtia/L=Izhevsk/O=IT animals/OU=IT/CN=user1"

4. Полученный от клиента запрос сохраняем в файл user.csr и выдаем на его основе сертификат (без модификации данных из запроса):
openssl req -x509 -newkey gost2012_512 -pkeyopt paramset:A -nodes -keyout key.pem -out cert.pem (нет)
openssl ca -engine gost -keyfile ./ca.key -cert ./ca.crt -in client.csr -out client.crt -batch (да)
Подпись файла:
openssl smime -engine gost -sign -in test.txt -out test_signed.txt -nodetach -binary -signer client.crt -inkey client.key -outform PEM

Проверка: 
openssl smime -verify -CAfile ca.crt -in test_signed.txt -inform pem -content test.txt -out /dev/null

5. проверка подписи на сервере:
openssl cms -engine gost -verify -in sign.cms -inform PEM -CAfile ca.crt -out data.file -certsout user.crt
Здесь sign.cms — файл, в котором находится подпись, ca.crt — файл с корневыми сертификатами, до одного из которых должна выстроиться цепочка, data.file — файл, в который будет сохранены подписанные данные, user.crt — файл, в который будет сохранен пользовательский сертификат. Именно из data.file нужно извлечь данные отсоединить последние 32 символа и сравнить salt.

6. Если на сервере нужно получить информацию из сертификата, то парсить его можно так:
6.1 Показать содержимое сертификата в текстовом представлении:
openssl x509 -in cert.pem -noout -text


6.2 Показать серийный номер сертификата:
openssl x509 -in cert.pem -noout -serial
6.3 Показать DN субъекта (subject):
openssl x509 -in cert.pem -noout -subject

6.4 Показать DN издателя:
openssl x509 -in cert.pem -noout -issuer

6.5 Показать почтовый адрес субъекта:
openssl x509 -in cert.pem -noout -email

 Показать время начала действия сертификата:
openssl x509 -in cert.pem -noout -startdate

6.7 Показать время окончания действия сертификата:
openssl x509 -in cert.pem -noout -enddate

