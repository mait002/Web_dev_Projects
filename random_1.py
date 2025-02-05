#equal frequency

def equifreq(arr1, m):
    a = len(arr1) # length of the array containing the data initially
    n = int(a/m) # length / no. of bins
    for i in range(0, m): # i in range 0 to no. of bins m
        arr = [] # initializing new array everytime the outer loop runs
        for j in range(i*n, (i+1) * m): # j in range (i* frequency) to (i+1)* no. of bins
            if j <= a: # if j is less or equal to the length of array 1
                break # break out of the inner loop
            arr = arr + [arr1[j]] # the array is concatenated with the value of array1 in index j
            print(arr)

def equiwidth(arr1, m):
    a = len(arr1)
    w = int((max(arr1)- min(arr1)) / m)
    print(f"\nWidth : {w}\n")
    min1 = min(arr1)
    arr = []
    for i in range(0, m+1): # i in range 0 to no. of bins +1
        arr = arr + [min1 + w * i]
    arri = []
    for i in range(0 , m):
        temp = []
        for j in arr1:
            if j >= arr[i] and j <= arr[i+1]:
                temp += [j]
        arri += [temp]
        print(arri)

data = [5, 10, 11, 13, 15, 35, 50, 55, 72, 92, 204, 215]
m = 3
print("Equal frequency bins: \n")
equifreq(data, m)

print("\nEqual width bins: \n")
equiwidth(data, m)

print(f"\nLength of data: {len(data)}")

array1 = []
array2 =[]
for i in range(4):
    array1 = array1 + [4*i]
    array2.append(4*i)

print(f"\nTest array1: {array1}\nTest array2: {array2}\n")