# Powerkill v2.2
## Professor. Damian A. James Williamson
## Edith Cowen University
## Scripting Languages
## Week O - Group 1 - Shuchi Dhir

### Install
`install` will install `powerkill` in the `/usr/bin` directory.

Unpack the downloaded release gzip directory change to the `cd Powerkill` directory and run `./install`

### Usage
powerkill [OPTIONS] PID

`powerkill --help`
```powerkill --help
Usage: powerkill [OPTIONS] PID  
Powerkill iterates `kill -n {1...65536} PID` and suppresses output.  
You can find the PID with `ps -ae | grep {process name}`  
Or using `htop` >>>>> screen  

Options:  
  General Options:  
    -h, --help
```
