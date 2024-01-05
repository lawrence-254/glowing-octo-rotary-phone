#!/usr/bin/env python3
import sys

def is_pal(word):
    word2 = ""
    for i in range(len(word) - 1, -1, -1):
        word2 += word[i]

    if word == word2:
        choice = "palindrome"
    else:
        choice = "not palindrome"

    print(word2)
    print(choice)

def main():
    if len(sys.argv) < 2:
        print("Please provide input on the command line.")
        return

    user_input = ' '.join(sys.argv[1:])
    is_pal(user_input)

if __name__ == "__main__":
    main()
