# Inverter and Weather Data Scraping Scripts

This repository contains a collection of PHP scripts designed for scraping data from various solar inverters and weather sources. The collected data is processed and stored in a MySQL database for analysis and reporting.

## Overview

These scripts automate the extraction of data from multiple sources, including Helios, SunnyWebBox, SMA inverters, and weather services. They aggregate and process this data into useful metrics, such as total kWh and kW values, and store it in a structured database.

## Files

1. **`config.php`**: Contains the configuration settings for database connections. Update this file with your database credentials to ensure proper connectivity.

2. **`simple_html_dom.php`**: A library for parsing HTML content. This script is used by other scraping scripts to extract data from HTML pages.

3. **`main.php`**: Serves as the central script to execute all individual scraping scripts at once. It provides a convenient way to run all data collection processes in one go.

4. **`HeliosLeft.php`**: Scrapes data from the Helios Left inverter, including power and performance metrics.

5. **`HeliosTata.php`**: Extracts data from the Helios Tata inverter. This script collects similar data to `HeliosLeft.php` but from a different model.

6. **`HeliosRight.php`**: Scrapes information from the Helios Right inverter, focusing on key performance indicators.

7. **`SunnyWebBox.php`**: Retrieves data from the SunnyWebBox inverter, including current power output and daily yield.

8. **`sma.php`**: Gathers data from SMA inverters. This script collects various performance metrics including power, current, and voltage.

9. **`kwhtotal.php`**: Processes the scraped inverter data to compute the total kWh values, aggregating data from all inverters.

10. **`totalkw.php`**: Similar to `kwhtotal.php`, this script processes data to compute total kW values, providing insights into the power output of the system.

11. **`weather.php`**: Scrapes current weather data from a specified online source. This information can be used to correlate with inverter performance.

12. **`nise_db_relation_schema.pdf`**: Provides a detailed schema of the `inverter_db` database, outlining the relationships between tables and their structures.

## Database

- **Database Name**: `inverter_db`

### Tables

- **`helios_left`**: Stores data related to the Helios Left inverter.
- **`helios_right`**: Contains data from the Helios Right inverter.
- **`helios_tata`**: Holds data from the Helios Tata inverter.
- **`kwh`**: Aggregated kWh data for analysis.
- **`sma_tb`**: Data from SMA inverters.
- **`sunnywebbox_tb`**: Data from SunnyWebBox inverters.
- **`total_kw`**: Contains aggregated kW values from all inverters.
- **`workshop`**: Table for workshop-specific data and metrics.

## Usage

1. **Configuration**: Update `config.php` with your database connection details.

2. **Running Scripts**: Execute `main.php` to run all individual scraping scripts. This will collect and process data from all sources.

3. **Database Schema**: Review `nise_db_relation_schema.pdf` to understand the database structure and relationships between tables.

4. **Scheduling**: Consider using a cron job or task scheduler to run `main.php` at regular intervals for continuous data collection.

## Contributing

Contributions are welcome! If you have improvements or additional features to add, please submit a pull request or open an issue to discuss.

## License

This project is licensed under the MIT License. See the [LICENSE](LICENSE) file for details.