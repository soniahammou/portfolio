### MCD mocodo 
https://www.mocodo.net/?mcd=eNplkEFOxDAMRdfNKXyALOiWHWKLRkgcoEpTT2tI4ypxQb09bpQOnWH35fi_73xxY4ZniG5GCwt_opeOBjO5bKG9wHsqIwtPFxBdNXWgFhq65XgVkqD-vM6zS5uFwCN5wqAoC688LygYPeYd_XK9UiAnOMAPyVTQt5i2hY-1r9xsTloTH1Py2teR56gB6l_Iy5p0cnLuoWZ0IWDaOq_BI6dNcY0e15Sl_csqq7eZeMaO04DJUIZA8QuE4f5Q1Y9I02PgqHUK33en-q0WYg7x13k6Sv93tHcRJveNhXCuosTfkL-RUZxE



tags : name, poject_id
has, 1N Project, 0N tags
Project : id_project, title, summary, status , picture
Affiliated with, 0N Project, 11 Subprojects
Subprojects : title, summary, subtitle, content, status

picture : 	id,	subproject,	logo
is link to , 0N Project, 0N picture
belongs to, 1N Project, 1N Logiciel
Logiciel : name
can have, 1N Subprojects , 0N Logiciel

user : email, roles, password


