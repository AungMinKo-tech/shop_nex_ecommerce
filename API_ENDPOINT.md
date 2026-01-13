# 💻 API ENDPOINTS

This document lists all API endpoints for ShopNex E_commerce project.

- **Local URL(Developement):** `http://127.0.0.1:8000/api/v1`

---

## 👮 Authentication APIs

| Method | Endpoint    | Description                |
| ------ | ----------- | -------------------------- |
| POST   | `/login`    | Login and get access token |
| POST   | `/register` | Register a new user        |
| POST   | `/logout`   | Logout current user        |

---

## ✨ Categories APIs

| Method | Endpoint           | Description          |
| ------ | ------------------ | -------------------- |
| GET    | `/categories`      | List all categories  |
| GET    | `/categories/{id}` | Show category detail |
| POST   | `/categories`      | New create category  |
| PUT    | `/categories/{id}` | Update category      |
| DELETE | `/categories/{id}` | Delete category      |

---

## 👨 User APIs

| Method | Endpoint      | Description      |
| ------ | ------------- | ---------------- |
| GET    | `/users`      | List all users   |
| GET    | `/users/{id}` | Show user detail |
| POST   | `/users`      | New create user  |
| PUT    | `/users/{id}` | Update user      |

---

## 🎸 Product APIs

| Method | Endpoint         | Description         |
| ------ | ---------------- | ------------------- |
| GET    | `/products`      | List all products   |
| GET    | `/products/{id}` | Show product detail |
| POST   | `/products`      | New create product  |
| PUT    | `/products/{id}` | Update product      |
| DELETE | `/products/{id}` | Delete product      |

---

## 🗑️ Cart APIs

| Method | Endpoint      | Description              |
| ------ | ------------- | ------------------------ |
| GET    | `/carts`      | List all carts items     |
| POST   | `/carts`      | Add product to cart      |
| PUT    | `/carts/{id}` | Update product quantity  |
| DELETE | `/carts/{id}` | Remove product from cart |
| DELETE | `/carts`      | Clear all cart items     |

---

## 🇨 Comment Type APIs

| Method | Endpoint         | Description        |
| ------ | ---------------- | ------------------ |
| GET    | `/comments`      | List all comments  |
| GET    | `/comments/{id}` | Show comment       |
| POST   | `/comments`      | New create comment |
| PUT    | `/comments/{id}` | Update comment     |
| DELETE | `/comments/{id}` | Delete comment     |

---

## 🖋️ Order APIs

| Method | Endpoint             | Description                      |
| ------ | -------------------- | -------------------------------- |
| GET    | `/orders`            | List all orders                  |
| GET    | `/orders/{id}`       | Show order detail                |
| POST   | `/orders`            | New create order                 |  |
| GET    | `/users/{id}/orders` | Show users's order (Client only) |

---

## 💸 Payment APIs

| Method | Endpoint         | Description        |
| ------ | ---------------- | ------------------ |
| GET    | `/payments`      | List all payment   |
| GET    | `/payments/{id}` | Show payment       |
| POST   | `/payments`      | New create payment |


---

## 📊 Payment Histories APIs

| Method | Endpoint                  | Description                      |
| ------ | ------------------------- | -------------------------------- |
| GET    | `/payment-histories`      | List all total Payment histories |
| GET    | `/payment-histories/{id}` | Show payment history detail      |
| POST   | `/payment-histories`      | New create payment history       |

---

## 🧮 Voucher APIs

| Method | Endpoint         | Description         |
| ------ | ---------------- | ------------------- |
| GET    | `/vouchers`      | List all vouchers   |
| GET    | `/vouchers/{id}` | Show voucher detail |
| POST   | `/vouchers`      | New create voucher  |
| PUT    | `/vouchers/{id}` | Update voucher      |
| DELETE | `/vouchers/{id}` | Delete voucher      |


---

## 🎉 Wishlist APIs

| Method | Endpoint     | Description        |
| ------ | ------------ | ------------------ |
| GET    | `/wishlists` | List all wishlists |


---

## 📞 Contact APIs

| Method | Endpoint         | Description         |
| ------ | ---------------- | ------------------- |
| GET    | `/contacts`      | List all contacts   |
| GET    | `/contatcs/{id}` | Show contact detail |
| DELETE | `/contatcs/{id}` | Delete contact      |


---
