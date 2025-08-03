# sayfood

Sayfood is a project in form of a web application to help restaurants reduce their waste. Restaurants would be able to sell their excess food in our website without getting profit from it. The money customers paid is actually for our team to use for charity. Our web application can also be a platform where people can create and participate on charity events.

- NOTE: This project is for learning purposes! It is not made to be operational in real world scenarios. The described company is fictional.

## Team Members
- Wesley Aldrich (Scrum Master)
- Putu Crysta Lovita Atmaja (Product Owner)
- Kalista Gabriela Willies
- Monica Agustina Chandra
- Naufal Dimas Azizan
- Teresa Naomi

## 🚀 Use Case Diagram

There are three physical actors in our system, i.e. Customer, Restaurant, Admin. We refer to **Customer** as someone who access our application to get food from restaurants by paying a relatively smaller amount of cost, while the money will be used by our company to donate to charities. **Customer**s may also create or participate in charity events. **Restaurant**s are able to sell their leftover foods in our application instead of throwing it all to waste. To monitor all the operations, our company also hire **Admin**s to make sure the system is in control. An **Admin** may approve restaurant registrations and event proposal, review reports, suspend malicious restaurants, or even export transaction reports for analytical purposes. Here is the use case diagram for a more complete view on our features and the actors.

<img width="835" height="1122" alt="image" src="https://github.com/user-attachments/assets/02bd1e2b-9b10-479f-a185-bd3a3c7f47e8" />

## ⚙️ Installation

1. Install the necessary files by running:
```bash
git clone https://github.com/wesleyaldrich/sayfood.git
cd sayfood

composer install
composer require spatie/laravel-activitylog
composer require --dev laravel/dusk
```

2. Configure `.env` by copying `.env.example` into it, either by using one of these:
```bash
cp .env.example .env
```
```bash
copy .env.example .env
```

3. Setup Apache/Nginx web server + mysql web server (modify the credentials in .env if necessary), then run this:
```bash
php artisan key:generate

php artisan migrate:fresh --seed

php artisan storage:link

php artisan serve
```

4. Setup your own credentials for these missing credentials in `.env`
```bash
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=
MAIL_PASSWORD=
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=
MAIL_FROM_NAME="${APP_NAME}"

GOOGLE_CLIENT_ID=
GOOGLE_CLIENT_SECRET=
GOOGLE_REDIRECT_URL=
```
