% POWERKILL(8) Powerkill User Manuals
% Professor. Damian A. James Williamson
% January 31, 2024

# NAME

powerkill - unified process kill level processor

# SYNOPSIS

powerkill [*options*] [*PID*]

# DESCRIPTION

Powerkill iterates over the process kill levels 1..65536 using all of the named
signal numbers from `kill -l \{1..64}` and additionally for unamed signal numbers.

Useful in cases to save time where `kill _PID_` does not immedately resolve closing
a process it deliberately overlooks `kill -n 0 _PID_` that for example does not
terminate cpueater.py where powerkill _PID_ does.

    powerkill 1234

Iterates kill -n \{1..65536} 1234

    powerkill `ps -ae | grep _process name_ | awk '{print $1}'`

Iterates kill -n \{1..65536} _PID_ of _process name_

# OPTIONS

-h, \--help
:   Show usage message. 
