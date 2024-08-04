type DebounceOptions = {
  leading?: boolean
}

export function debounce<T extends (...args: any[]) => void>(
  func: T,
  delay: number,
  options: DebounceOptions = {}
): (...args: Parameters<T>) => void {
  let timerId: ReturnType<typeof setTimeout> | undefined

  return (...args: Parameters<T>) => {
    if (!timerId && options.leading) {
      func(...args)
    }

    if (timerId) {
      clearTimeout(timerId)
    }

    timerId = setTimeout(() => func(...args), delay)
  }
}
