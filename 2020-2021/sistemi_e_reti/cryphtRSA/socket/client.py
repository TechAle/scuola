import socket
import threading
from cryptography.hazmat.primitives import serialization
from cryptography.hazmat.backends import default_backend
from cryptography.hazmat.primitives.asymmetric import padding
from cryptography.hazmat.primitives import hashes

## Leggiamo privata
with open("../public_key.pem", "rb") as key_file:
    public_key = serialization.load_pem_public_key(
        key_file.read(),
        backend=default_backend()
    )

def invia():
    msg = input("Messaggio: ")
    send(msg)

def send(msg):
    encrypted = public_key.encrypt(
        msg.encode(FORMAT),
        padding.OAEP(
            mgf=padding.MGF1(algorithm=hashes.SHA256()),
            algorithm=hashes.SHA256(),
            label=None
        )
    )
    msg_len = str(len(encrypted)).encode(FORMAT)
    msg_len += b' ' * (LEN_MSG - len(msg_len))
    CLIENT.send(msg_len)
    CLIENT.send(encrypted)

IP = socket.gethostbyname(socket.gethostname())
PORTA = 9000
ADDR = (IP, PORTA)

CLIENT = socket.socket(socket.AF_INET, socket.SOCK_STREAM)

FORMAT = "utf-8"
LEN_MSG = 1024
print("connetto")
CLIENT.connect(ADDR)
print("connesso")

threading.Thread(target = invia).start()

while True:
    msg_len = CLIENT.recv(LEN_MSG).decode(FORMAT)
    if msg_len:
        msg = CLIENT.recv(int(LEN_MSG)).decode(FORMAT)
        print("ricevuto " + msg)
