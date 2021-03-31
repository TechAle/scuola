import socket
import threading
from cryptography.hazmat.backends import default_backend
from cryptography.hazmat.primitives import serialization
from cryptography.hazmat.primitives.asymmetric import rsa
from cryptography.hazmat.primitives.asymmetric import padding
from cryptography.hazmat.primitives import hashes

## Leggiamo privata
with open("../private_key.pem", "rb") as key_file:
    private_key = serialization.load_pem_private_key(
        key_file.read(),
        password=None,
        backend=default_backend()
    )

# lsof -P | grep ':9000' | awk '{print $2}' | xargs kill -9
def gest_cliente(conn, addr):
    while True:
        msg_len = conn.recv(LEN_MSG).decode(FORMAT)
        if msg_len:
            msg = conn.recv(int(msg_len))
            send(msg, conn)


def send(msg, conn):
    messaggio = private_key.decrypt(
        msg,
        padding.OAEP(
            mgf=padding.MGF1(algorithm=hashes.SHA256()),
            algorithm=hashes.SHA256(),
            label=None
        )
    )
    print(messaggio)
    msg = str(msg)
    message = msg.encode(FORMAT)
    msg_len = str(len(message)).encode(FORMAT)
    msg_len += b' ' * (LEN_MSG - len(msg_len))
    for i in connessioni:
        if i != conn:
            i.send(msg_len)
            i.send(message)

IP = socket.gethostbyname(socket.gethostname())
PORTA = 9000
ADDR = (IP, PORTA)

SERVER = socket.socket(socket.AF_INET, socket.SOCK_STREAM)

FORMAT = "utf-8"
LEN_MSG = 1024


SERVER.bind(ADDR)
print("ascolto")
SERVER.listen()

connessioni = []

while True:
    conn, addr = SERVER.accept()
    print(f"accettato {addr}")
    connessioni.append(conn)
    threading.Thread(target = gest_cliente, args = (conn, addr)).start()
