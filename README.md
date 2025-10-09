# Powerkill v2.3
## Professor. Damian A. James Williamson Grad.
## Edith Cowen University Alumni.
## Scripting Languages
## Week O - Group 1 - Shuchi Dhir

### Install
`install` will install `powerkill` in the `/usr/bin` directory.

Unpack the downloaded release gzip directory change to the `cd Powerkill` directory and run `./install`

`install.bin` install compiled. dependency: shc, gcc

### Usage
powerkill [OPTIONS] PID

`-a --all` Iterate all process kill levels

`powerkill --help`
```powerkill --help
Usage: powerkill [OPTIONS] PID  
Powerkill iterates `kill -n {1...65536} PID` and suppresses output.  
You can find the PID with `ps -ae | grep {process name}`  
Or using `htop` >>>>> screen  

Try; pgrep {process name} | xargs powerkill

Options:  
  General Options:  
    -a, --all
    -h, --help
```
