## Overview

This project is to manage seller product and how many product sold. Think is I'm the reseller of many product of many seller. I will help seller to sell their product with some price. Of course this price is higher than original price to to take advantage of me as a reseller.

## Phase

This project have 2 phase. First phase I want to implement CRUD that covered my goal withou authentication. Phase 2 I want add some authentication .

## DB Schema

- sellers
  - id integer auto increment
  - name varchar required
- products
  - id integer auto increment
  - name varchar required
  - sell_price integer required
  - original_price integer required
  - seller_id integer required foreign key to table sellers
- daily_sold_products
  - id integer auto increment
  - product_id integer required foreign key to table products
  - date format YYYY-MM-DD required
  - stock integer required
  - sold integer required

## Tech Stack

- This project using yii 2 framework with mysql database

## Goal

I want to create simple CRUD that each table have a page to

- Create and Edit data
  That represent in url like '/{table_name}/create' or '/{table_name}/edit'. I want the view using one component, but there is a params to diff the component maybe like 'isEdit'. And if any field that relation to other table. Please using select input
- List of data using datatable
  That represent in url like '/{table_name}'. And there is filter, soring, and pagination
  - For page list sellers
    Column
    - No. ordered number based on data and pagination.
      Sorting : ASC, DESC
    - Name. Get from column name
      Sorting : ASC, DESC
  - For page list products
    Column
    - No. ordered number based on data and pagination.
      Sorting : ASC, DESC
    - Name. Get from column name
      Sorting : ASC, DESC
    - Sell Price. Get from sell_price column
      Sorting : ASC, DESC
    - Original Price. Get from original_price column
      Sorting : ASC, DESC
    - Seller. Get from seller_id name
      Sorting : ASC, DESC by name in sellers table
      Filter
    - Seller. Filter by seller_id. Select input and displayed by name
  - For page Daily Sold Prdocuts
    Column
    - No. ordered number based on data and pagination.
      Sorting : ASC, DESC
    - Product. Get from name in table products
      Sorting : ASC, DESC
    - Seller. Get from name in table sellers
      Sorting : ASC, DESC
    - Date. Get from date
      Sorting : ASC, DESC based on date
    - Stock. Get data from stock
      Sorting : ASC, DESC based on date
    - Sold. Get data from sold
      Sorting : ASC, DESC based on date
    Filter
    - Seller. Filter by seller_id. Select input and displayed by name
    - Date. Filter by date
  - Pagination
    There is options 5, 10, 20, 50, and 100 per page
