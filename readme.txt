=== Microtango ===
Contributors: microtango
Tags: Microtango, Tanzschule, Übersicht, Kurse, Anmeldung
Requires at least: 4.0.0
Requires PHP: 5.6.0
Tested up to: 6.4.0
Stable tag: 0.9.26
License: MIT License
License URI: http://opensource.org/licenses/MIT

Microtango WP integration. Requires subscription from DMS. Will include the Microtango REST API to show your cloud data.

== Description ==

Microtango WP integration. Requires subscription from DMS. Will include the Microtango REST API to show your cloud data.

= Features include: =

* Install four shortcodes: **mt_courses**, **mt_reservation**, **mt_video** and **mt_form**.

= Usage: =

<blockquote>
[mt_courses]
or
[mt_courses webcategory="WTP2"]
or
[mt_courses webcategory="WTP2" orderby="StartWeekday, Name"]
or
[mt_courses webcategory="WTP1"]Kursname|{{Subject}} ({{Name}})#Tag / Zeit|{{StartWeekdayText}} {{Timespan}}#Startdatum|{{StartDateText}}#|{{AttendButton}}[/mt_courses]
or
[mt_courses webcategory="WTP1"]Kursname|{{Subject}} ({{Name}})#1. Termin|{{DatesText.[0]}}#2. Termin|{{DatesText.[1]}}#3. Termin|{{DatesText.[2]}}#|{{AttendButton}}[/mt_courses]

[mt_reservation]

[mt_video]
or
[mt_video videogroup="GK"]
</blockquote>

<h4>mt_courses parameter:</h4>
* mtattendform (optional): If set, the mt build form will be used fo attendance. Possible values: popup (default) or standalone
* webcategory (optional): Webcategory filter
* orderby (optional): Order of results
* template (optional): 1-9, select one of the additional templates
* templateid (optional): Id of html template
* category (optional): Category filter
* attendurl: Url for the attend form


Content [mt_courses] ... [/mt_courses]: The content of the courses table in the format Column title | {{FieldName}}#Column title | {{FieldName}}
Default:
Kurs|{{Subject}}#Start|{{StartDateText}}#Von|{{Timespan}}#Stunden|{{RepeatCount}}#Verfügbarkeit|{{AvailabilityText}}#|{{AttendButton}}

FieldName: Values from microtango rest API (https://api.microtango.de/swagger -> RESTCourseModel). Possible values:
* Id: adea471d-d109-416f-9638-5362b490b37a
* Season: 21-1
* Name: 3TK-06
* Subject: Paare Tanzkreis Fr
* StartDate: 2021-01-01T00:00:00
* StartDateText: 01.01.2021
* StartTime: 20:30:00
* StartTimeText: 20:30
* StartWeekday: 5
* StartWeekdayText: Freitag
* StartMonthText: Januar
* EndDate: 2021-12-24T00:00:00
* EndDateText: 24.12.2021
* EndTime: 21:30:00
* EndTimeText: 21:30
* EndWeekday: 5
* EndWeekdayText: Freitag
* EndMonthText: Dezember
* Timespan: 20:30 - 21:30
* Length: 1 Stunde
* TimeCondition: wöchentlich 1 Stunde
* Price: 0
* PriceClub: 35
* PriceText: 35,00
* PriceTextFull: 35,00 € monatlich
* HallName: Großer Saal
* HallAddress: Testweg 1, 12345 Musterhausen
* TeacherName: Dr. Sch. Nitzel
* AssistantName: Ein Name
* ProgramName: Grundkurs 1
* Category: GK
* WebCategory: Grundkurs1
* Availability: G, Y or R
* AvailabilityText: Plätze verfügbar, Wenig Plätze verfügbar, Ausgebucht
* RepeatCount: 12
* SkipDays: 7
* WebNotes: Sonstige Informationen
* AttendFormShowPartner: true
* AttendFormShowLegalGuardian: false
* FreeText1, FreeText2, FreeText3, FreeText4, FreeText5, FreeText6, FreeText7, FreeText8, FreeText9
* DatesText.[x]: 04.05.2023 (x= 0 - RepeatCount)
* Dates.[x]: 2023-05-04T18:00:00 (x= 0 - RepeatCount)

Special fields:
* Attend: Attend: Generate attend link
* AttendButton: Generate attend button with booked information
* ScheduleInfo: Popup with timetable

Example:
[mt_courses]
or
[mt_courses webcategory="WTP2"]
or
[mt_courses webcategory="WTP2" orderby="StartWeekday, Name"]
or
[mt_courses webcategory="WTP1"]Kursname|{{Subject}}{{Name}}#Tag / Zeit|{{StartWeekdayText}} {{Timespan}}#Startdatum|{{StartDateText}}#|{{Attend}}[/mt_courses]

<h4>mt_reservation:</h4>
Will show the online reservation form for customers.

<h4>mt_video:</h4>
Will show the available videos for customers.
Example:
[mt_video videogroup="GK"]
[mt_video videogroup="GK", videoPublic=true]

<h4>mt_form parameter:</h4>
* restkey: Microtango REST Key
* formid (optional): The id of the form to use (Default: The form direct before [mt_form])
* redirecturl: Url to redirect to, after the form post. Build a nice "We received your registration" page here.
* testmode (optional): If true, no registration, instead we return the mapped values as a html page.

Content [mt_form] ... [/mt_form]: The fieldmapping in the format RESTApi field=Form field name#RESTApi field=Form field name
Form field name: Use Browser F12 tools
RESTApi field: Values from microtango rest API (https://api.microtango.de/swagger -> OnlineRegistrationModel). Possible values:
Season, SeasonID, Course, CourseID: Will be set by the api in hidden fields
FirstName, MiddleName, LastName, Gender, Street, Street2, ZIPCode, City, Birthday, Phone, Cell, EMail, AccountOwner, IBAN, BIC, Notes, PartnerFirstname, PartnerMiddlename, PartnerLastname, PartnerGender, PartnerStreet, PartnerStreet2, PartnerZIPCode, PartnerCity, PartnerBirthday, PartnerPhone, PartnerCell, PartnerEMail, PartnerAccountOwner, PartnerIBAN, PartnerBIC, PartnerNotes

Example:
[mt_form restkey="ABCDEFGH" redirecturl="/" testmode="true"]subject=wpforms[fields][3]#course=wpforms[fields][4]#firstname=wpforms[fields][0][first]#lastname=wpforms[fields][0][last]#email=wpforms[fields][1][/mt_form]

== Installation ==
Use the standard WordPress plugins search and installer.
Activate the plugin.
Use the plugin under the Tools menu in the WordPress admin

Manual Installation

1. Upload the `microtango` folder to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress

== Frequently Asked Questions ==

= Where do you use this plugin? =

Under the Tools menu in the dashboard there will be a "Microtango" link.

== Screenshots ==

1. Typical settings page.

== Changelog ==

= 0.9.26 =
* Optimization for preview of changes

= 0.9.25 =
* Add StartWeekday and EndWeekday as Number (1=Monday, 7=Sunday)
* Add orderby Parameter to mt_courses. E.g.[mt_courses orderby="StartWeekday, Name"] to sort by Weekday and then by Name.

= 0.9.24 =
* Add missing Dates.[x] (x= 0 - RepeatCount) to documentation
* Add missing DatesText.[x] (x= 0 - RepeatCount) to documentation

= 0.9.23 =
* Fix missing templates 2-9

= 0.9.22 =
* Add "Disabled" to the settings. Will disable the plugin, but still show the plugin in preview.
* Add additional 9 course templates to settings. The templates can used with the template parameter for mt_courses shortcut. E.g [mt_courses template=1].

= 0.9.21 =
* Small fixes

= 0.9.20 =
* Add videoPublic parameter to video shortcode

= 0.9.19 =
* Fix missing RestKey for video

= 0.9.18 =
Small fixes

= 0.9.17 =
Small fixes

= 0.9.16 =
* WP Version 4.0.0 - 5.8.1

= 0.9.15 =
* Fallback to popup, if mtattendform is missing

= 0.9.14 =
* Reintroduce old attend link and add new attend button

= 0.9.13 =
* Remove old attend button

= 0.9.12 =
* Bugfix for multi inline templates

= 0.9.11 =
* Small bugfix

= 0.9.10 =
* Template for mt_video

= 0.9.9 =
* Add possible field to readme

= 0.9.8 =
* Translate setting defaults to german

= 0.9.7 =
* Translate setting defaults to german

= 0.9.6 =
* Add video function

= 0.9.5 =
* Fix for missing default value (load css, load template)

= 0.9.4 =
* Documentation update. Support for PartnerMandatory parameter

= 0.9.3 =
* Change cdn resource names

= 0.9.2 =
* Move resources to cdn

= 0.9.1 =
* Fix for Safari blocking 3rd party cookies

= 0.9.0 =
* Add online-reservation handling

= 0.8.3 =
* Small JS error handling

= 0.8.2 =
* Documentation update

= 0.8.1 =
* Missing course not found fix

= 0.8.0 =
* Shortcodes renaming

= 0.7.0 =
* Naming fixes for release

= 0.6.0 =
* First catalog upload

= 0.6.0 =
* Include js and css
* JS handling for wp

= 0.4.0 =
* Add settings page
- Setting for API rest Key
- Setting for default list row settings

= 0.3.0 =
* MT attend form handling

= 0.2.0 =
* Some readme text

= 0.1.0 =
* Initial release
