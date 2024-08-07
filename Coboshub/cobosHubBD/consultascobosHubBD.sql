select 
U.nombreUsuario, 
U.emailUsuario, 
L.claveLogin, 
L.claveLogin, 
RU.nombreRolUsuario 
from
usuario as U join login as L 
on(U.idusuario = L.idusuario)
join rolusuario as RU
on(L.idRolUsuario = RU.idRolUsuario);