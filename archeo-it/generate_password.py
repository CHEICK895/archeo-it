import sys
import random
import string

def generate_password(mode, length):
    if mode == "1":
        chars = string.ascii_letters
    elif mode == "2":
        chars = string.ascii_letters + string.digits
    elif mode == "3":
        chars = string.ascii_letters + string.digits + string.punctuation
    else:
        return "INVALID"

    return ''.join(random.choices(chars, k=int(length)))

if __name__ == "__main__":
    mode = sys.argv[1]
    length = sys.argv[2]
    print(generate_password(mode, length))
